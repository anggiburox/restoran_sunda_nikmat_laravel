<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\ProdukModel;
use App\Models\ProdukMasukModel;
use App\Models\TransaksiModel;
use Illuminate\Support\Facades\DB;

class DashboardControllerSPVOwner extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware(LoginFilterMiddleware::class);
    // }
    
    public function index()
    {  
        $users = UsersModel::count();
        $produk = ProdukModel::count();
        $produk_masuk = ProdukMasukModel::count();
        $transaksi = TransaksiModel::count();
        return view('pages/spv_owner/dashboard', [
            'users'=>$users, 
            'produk'=>$produk,
            'produk_masuk'=>$produk_masuk,
            'transaksi'=>$transaksi,
        ]);
    }

    public function grafikpajak(Request $request)
    {
        $periodeawal = $request->awal;
        $periodeakhir = $request->akhir;

        $data = DB::table('transaksi')
            ->join('transaksi_detail', 'transaksi_detail.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
            ->join('produk', 'produk.ID_produk', '=', 'transaksi_detail.ID_produk')
            ->select(
                'transaksi.Tanggal_Transaksi',
                DB::raw('GROUP_CONCAT(transaksi_detail.Biaya_Service) as detail_Biaya_Service'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Biaya_BP) as detail_Biaya_BP'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Total) as detail_Total'),


            )->whereBetween('transaksi.Tanggal_Transaksi', [$periodeawal, $periodeakhir])
            ->groupBy('transaksi.Tanggal_Transaksi')
            ->get();
        $totalBiayaPBPerTanggal = [];
        $totalBiayaServicePerTanggal = [];
        $totalBiayaTanggal = [];

        // Loop melalui setiap entri dalam $data
        foreach ($data as $item) {
            $tanggal = $item->Tanggal_Transaksi;
            $biayaService = $item->detail_Biaya_Service;
            $biayaPB = $item->detail_Biaya_BP;
            $biayaPB = $item->detail_Total;

            $biayaServiceArray = explode(',', str_replace(['Rp. ', '.'], '', $biayaService));
            $biayaPBArray = explode(',', str_replace(['Rp. ', '.'], '', $biayaPB));

            // Konversi setiap elemen dalam array menjadi integer
            $biayaServiceArray = array_map(function ($biaya) {

                return intval($biaya);
            }, $biayaServiceArray);
            $biayaPBArray = array_map(function ($biayapb) {

                return intval($biayapb);
            }, $biayaPBArray);


            // Hitung total biaya service untuk entri ini
            $totalBiayaService = array_sum($biayaServiceArray);
            $totalBiayaPB = array_sum($biayaPBArray);

            // Simpan total biaya service per Tanggal_Transaksi
            if (array_key_exists($tanggal, $totalBiayaServicePerTanggal)) {
                $totalBiayaServicePerTanggal[$tanggal] += $totalBiayaService;
            } else {
                $totalBiayaServicePerTanggal[$tanggal] = $totalBiayaService;
            }
            if (array_key_exists($tanggal, $totalBiayaPBPerTanggal)) {
                $totalBiayaPBPerTanggal[$tanggal] += $totalBiayaPB;
            } else {
                $totalBiayaPBPerTanggal[$tanggal] = $totalBiayaPB;
            }
        }

        $totalBiayaPerTanggal = [];
        foreach ($totalBiayaServicePerTanggal as $tanggal => $totalService) {
            if (array_key_exists($tanggal, $totalBiayaPBPerTanggal)) {
                $totalPB = $totalBiayaPBPerTanggal[$tanggal];
            } else {
                $totalPB = 0;
            }
            $totalBiayaPerTanggal[$tanggal] = [
                'totalService' => $totalService,
                'totalPB' => $totalPB,
            ];
        }

        return response()->json($totalBiayaPerTanggal);
    }
    public function grafikpenjualan(Request $request)
    {
        $periodeawal = $request->awal;
        $periodeakhir = $request->akhir;

        $data = DB::table('transaksi')
            ->join('transaksi_detail', 'transaksi_detail.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
            ->join('produk', 'produk.ID_produk', '=', 'transaksi_detail.ID_produk')
            ->select(
                'transaksi.Tanggal_Transaksi',
                DB::raw('GROUP_CONCAT(transaksi_detail.Total) as detail_Total'),
            )->whereBetween('transaksi.Tanggal_Transaksi', [$periodeawal, $periodeakhir])
            ->groupBy('transaksi.Tanggal_Transaksi')
            ->get();
        $totalPerTanggal = [];

        // Loop melalui setiap entri dalam $data
        foreach ($data as $item) {
            $tanggal = $item->Tanggal_Transaksi;
            $total = $item->detail_Total;

            $totalArray = explode(',', str_replace(['Rp. ', '.'], '', $total));

            // Konversi setiap elemen dalam array menjadi integer
            $totalArray = array_map(function ($biaya) {

                return intval($biaya);
            }, $totalArray);
           


            // Hitung total biaya service untuk entri ini
            $sumtotal = array_sum($totalArray);

            // Simpan total biaya service per Tanggal_Transaksi
            if (array_key_exists($tanggal, $totalPerTanggal)) {
                $totalPerTanggal[$tanggal] += $sumtotal;
            } else {
                $totalPerTanggal[$tanggal] = $sumtotal;
            }
           
        }

        // $totalBiayaPerTanggal = [];
        // foreach ($totalPerTanggal as $tanggal => $totalService) {
        //     if (array_key_exists($tanggal, $totalBiayaPBPerTanggal)) {
        //         $totalPB = $totalBiayaPBPerTanggal[$tanggal];
        //     } else {
        //         $totalPB = 0;
        //     }
        //     $totalBiayaPerTanggal[$tanggal] = [
        //         'totalService' => $totalService,
        //         'totalPB' => $totalPB,
        //     ];
        // }

        return response()->json($totalPerTanggal);
    }
}