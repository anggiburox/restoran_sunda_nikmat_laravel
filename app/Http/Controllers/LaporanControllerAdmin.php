<?php

namespace App\Http\Controllers;

use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class LaporanControllerAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request){
        //     dd($request->all);
        // }
        // mengambil data dari table produk
        $pgw = TransaksiModel::produkjointransaksi();
        // mengirim data produk ke view index
        return view('pages/admin/laporan/index', ['pgw' => $pgw]);
    }

    public function laporan_data_transaksi(Request $request)
    {
        $start_date = $request->periodeawal;
        $end_date = $request->periodeakhir;
        $pgw =  DB::table('transaksi')
            ->join('transaksi_detail', 'transaksi_detail.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
            ->join('produk', 'produk.ID_produk', '=', 'transaksi_detail.ID_produk')
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                return $query->whereBetween('transaksi.Tanggal_Transaksi', [$start_date, $end_date]);
            })
            ->get();
        $count =  DB::table('transaksi')->count();


        return view('pages/admin/laporan/laporan_data_transaksi', ['pgw' => $pgw, 'count' => $count]);
    }

    public function laporan_penjualan_detail(Request $request)
    {
        $start_date = $request->periodeawal;
        $end_date = $request->periodeakhir;

        $pgw = DB::table('transaksi')
            ->join('transaksi_detail', 'transaksi_detail.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
            ->join('produk', 'produk.ID_produk', '=', 'transaksi_detail.ID_produk')
            ->select(
                'transaksi.ID_Transaksi',
                'transaksi.Tanggal_Transaksi',
                'transaksi.Nama_Customer',
                'transaksi.No_Meja',
                DB::raw('GROUP_CONCAT(produk.Harga_Satuan_Produk) as produk_harga'),
                DB::raw('GROUP_CONCAT(produk.Nama_Produk) as produk_names'),
                DB::raw('GROUP_CONCAT(transaksi_detail.ID_Transaksi) as detail_ID_Transaksi'),
                DB::raw('GROUP_CONCAT(transaksi_detail.ID_Produk) as detail_ID_Produk'),
                DB::raw('GROUP_CONCAT(transaksi_detail.QTY) as detail_QTY'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Sub_Total) as detail_Sub_Total'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Tarif_Biaya_Service) as detail_Tarif_Biaya_Service'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Biaya_Service) as detail_Biaya_Service'),
                DB::raw('GROUP_CONCAT(transaksi_detail.DPP) as detail_DPP'),
                DB::raw('GROUP_CONCAT(transaksi_detail.BP) as detail_BP'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Biaya_BP) as detail_Biaya_BP'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Total) as detail_Total'),
                // DB::raw('(SELECT COUNT(*) FROM transaksi AS t WHERE t.ID_Transaksi = transaksi.ID_Transaksi) as count')
            )->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                return $query->whereBetween('transaksi.Tanggal_Transaksi', [$start_date, $end_date]);
            })
            ->groupBy('transaksi.ID_Transaksi','transaksi.Tanggal_Transaksi','transaksi.Nama_Customer','transaksi.No_Meja')
            ->get();
        // dd($pgw);
        $count =  DB::table('transaksi')->count();


        return view('pages/admin/laporan/laporan_penjualan_detail', ['pgw' => $pgw, 'count' => $count, 'start_date' => $start_date, 'end_date' => $end_date]);
        // $pgw = TransaksiModel::produkjointransaksi();
    }

    public function laporan_pb1_dan_biaya_service(Request $request)
    {
        $start_date = $request->periodeawal;
        $end_date = $request->periodeakhir;
        $pgw = DB::table('transaksi')
            ->join('transaksi_detail', 'transaksi_detail.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
            ->join('produk', 'produk.ID_produk', '=', 'transaksi_detail.ID_produk')
            ->select(
                'transaksi.ID_Transaksi',
                'transaksi.Tanggal_Transaksi',
                'transaksi.Nama_Customer',
                'transaksi.No_Meja',
                DB::raw('GROUP_CONCAT(produk.Harga_Satuan_Produk) as produk_harga'),
                DB::raw('GROUP_CONCAT(produk.Nama_Produk) as produk_names'),
                DB::raw('GROUP_CONCAT(transaksi_detail.ID_Transaksi) as detail_ID_Transaksi'),
                DB::raw('GROUP_CONCAT(transaksi_detail.ID_Produk) as detail_ID_Produk'),
                DB::raw('GROUP_CONCAT(transaksi_detail.QTY) as detail_QTY'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Sub_Total) as detail_Sub_Total'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Tarif_Biaya_Service) as detail_Tarif_Biaya_Service'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Biaya_Service) as detail_Biaya_Service'),
                DB::raw('GROUP_CONCAT(transaksi_detail.DPP) as detail_DPP'),
                DB::raw('GROUP_CONCAT(transaksi_detail.BP) as detail_BP'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Biaya_BP) as detail_Biaya_BP'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Total) as detail_Total'),
                // DB::raw('(SELECT COUNT(*) FROM transaksi AS t WHERE t.ID_Transaksi = transaksi.ID_Transaksi) as count')
            )->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                return $query->whereBetween('transaksi.Tanggal_Transaksi', [$start_date, $end_date]);
            })
            ->groupBy('transaksi.ID_Transaksi','transaksi.Tanggal_Transaksi','transaksi.Nama_Customer','transaksi.No_Meja')
            ->get();
        $count =  DB::table('transaksi')->count();


        return view('pages/admin/laporan/laporan_pb1_dan_biaya_service', ['pgw' => $pgw, 'count' => $count, 'start_date' => $start_date, 'end_date' => $end_date]);
        // $pgw = TransaksiModel::produkjointransaksi();
    }


    public function cetak_laporan_data_transaksi()
    {
        $data =  DB::table('transaksi')
            ->join('transaksi_detail', 'transaksi_detail.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
            ->join('produk', 'produk.ID_produk', '=', 'transaksi_detail.ID_produk')
            ->get();

        $count =  DB::table('transaksi')->count();

        $pgw = [
            'data' => $data,
            'count' => $count
        ];
        $pdf = PDF::loadView('pdf.laporan_penjualan_transaksi_detail', $pgw);
        return $pdf->stream('invoice.pdf');
    }


    public function cetak_laporan_penjualan_detail(Request $request)
    {
        $periodeawal = $request->cetakperiodeawal;
        $periodeakhir = $request->cetakperiodeakhir;
        $data = DB::table('transaksi')
            ->join('transaksi_detail', 'transaksi_detail.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
            ->join('produk', 'produk.ID_produk', '=', 'transaksi_detail.ID_produk')
            ->select(
                'transaksi.ID_Transaksi',
                'transaksi.Tanggal_Transaksi',
                'transaksi.Nama_Customer',
                'transaksi.No_Meja',
                DB::raw('GROUP_CONCAT(produk.Harga_Satuan_Produk) as produk_harga'),
                DB::raw('GROUP_CONCAT(produk.Nama_Produk) as produk_names'),
                DB::raw('GROUP_CONCAT(transaksi_detail.ID_Transaksi) as detail_ID_Transaksi'),
                DB::raw('GROUP_CONCAT(transaksi_detail.ID_Produk) as detail_ID_Produk'),
                DB::raw('GROUP_CONCAT(transaksi_detail.QTY) as detail_QTY'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Sub_Total) as detail_Sub_Total'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Tarif_Biaya_Service) as detail_Tarif_Biaya_Service'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Biaya_Service) as detail_Biaya_Service'),
                DB::raw('GROUP_CONCAT(transaksi_detail.DPP) as detail_DPP'),
                DB::raw('GROUP_CONCAT(transaksi_detail.BP) as detail_BP'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Biaya_BP) as detail_Biaya_BP'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Total) as detail_Total'),
                // DB::raw('(SELECT COUNT(*) FROM transaksi AS t WHERE t.ID_Transaksi = transaksi.ID_Transaksi) as count')
            )->whereBetween('transaksi.Tanggal_Transaksi', [$periodeawal, $periodeakhir])
            ->groupBy('transaksi.ID_Transaksi','transaksi.Tanggal_Transaksi','transaksi.Nama_Customer','transaksi.No_Meja')
            ->get();
            Carbon::setLocale('id');
            $periodeawal = Carbon::createFromFormat('Y-m-d', $periodeawal)->translatedFormat('d F Y');
            $periodeakhir = Carbon::createFromFormat('Y-m-d', $periodeakhir)->translatedFormat('d F Y');

        $count =  DB::table('transaksi')->count();

        $pgw = [
            'data' => $data,
            'count' => $count,
            'periodeawal' => $periodeawal,
            'periodeakhir' => $periodeakhir
        ];
        $pdf = PDF::loadView('pdf.laporan_transaksi_detail', $pgw);
        return $pdf->stream('Laporan_Penjualan_Detail.pdf');
    }

    public function cetak_laporan_pb1_dan_biaya_service(Request $request)
    {
        $periodeawal = $request->cetakperiodeawal;
        $periodeakhir = $request->cetakperiodeakhir;
    //    dd(periode)
        $data = DB::table('transaksi')
            ->join('transaksi_detail', 'transaksi_detail.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
            ->join('produk', 'produk.ID_produk', '=', 'transaksi_detail.ID_produk')
            ->select(
                'transaksi.ID_Transaksi',
                'transaksi.Tanggal_Transaksi',
                'transaksi.Nama_Customer',
                'transaksi.No_Meja',
                DB::raw('GROUP_CONCAT(produk.Harga_Satuan_Produk) as produk_harga'),
                DB::raw('GROUP_CONCAT(produk.Nama_Produk) as produk_names'),
                DB::raw('GROUP_CONCAT(transaksi_detail.ID_Transaksi) as detail_ID_Transaksi'),
                DB::raw('GROUP_CONCAT(transaksi_detail.ID_Produk) as detail_ID_Produk'),
                DB::raw('GROUP_CONCAT(transaksi_detail.QTY) as detail_QTY'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Sub_Total) as detail_Sub_Total'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Tarif_Biaya_Service) as detail_Tarif_Biaya_Service'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Biaya_Service) as detail_Biaya_Service'),
                DB::raw('GROUP_CONCAT(transaksi_detail.DPP) as detail_DPP'),
                DB::raw('GROUP_CONCAT(transaksi_detail.BP) as detail_BP'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Biaya_BP) as detail_Biaya_BP'),
                DB::raw('GROUP_CONCAT(transaksi_detail.Total) as detail_Total'),
                // DB::raw('(SELECT COUNT(*) FROM transaksi AS t WHERE t.ID_Transaksi = transaksi.ID_Transaksi) as count')
            )->whereBetween('transaksi.Tanggal_Transaksi', [$periodeawal, $periodeakhir])
            ->groupBy('transaksi.ID_Transaksi','transaksi.Tanggal_Transaksi','transaksi.Nama_Customer','transaksi.No_Meja')
            ->get();

            Carbon::setLocale('id');
            $periodeawal = Carbon::createFromFormat('Y-m-d', $periodeawal)->translatedFormat('d F Y');
            $periodeakhir = Carbon::createFromFormat('Y-m-d', $periodeakhir)->translatedFormat('d F Y');

        $count =  DB::table('transaksi')->count();

        $pgw = [
            'data' => $data,
            'count' => $count,
            'periodeawal' => $periodeawal,
            'periodeakhir' => $periodeakhir
        ];
        $pdf = PDF::loadView('pdf.laporan_pajak_detail', $pgw);
        return $pdf->stream('Laporan_Pajak.pdf');
    }
}
