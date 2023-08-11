<?php

namespace App\Http\Controllers;

use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanControllerSPVOwner extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // mengambil data dari table produk
        $pgw = TransaksiModel::produkjointransaksi();
    	// mengirim data produk ke view index
        return view('pages/spv_owner/laporan/index',['pgw' => $pgw]);
    }
    
    public function laporan_penjualan_detail()
    {

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
            )
            ->groupBy('transaksi.ID_Transaksi','transaksi.Tanggal_Transaksi','transaksi.Nama_Customer','transaksi.No_Meja')
            ->get();
        // dd($pgw);
        $count =  DB::table('transaksi')->count();


        return view('pages/spv_owner/laporan/laporan_penjualan_detail', ['pgw' => $pgw, 'count' => $count]);
        // $pgw = TransaksiModel::produkjointransaksi();
    }

    public function laporan_pb1_dan_biaya_service()
    {

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
            )
            ->groupBy('transaksi.ID_Transaksi','transaksi.Tanggal_Transaksi','transaksi.Nama_Customer','transaksi.No_Meja')
            ->get();
        $count =  DB::table('transaksi')->count();


        return view('pages/spv_owner/laporan/laporan_pb1_dan_biaya_service', ['pgw' => $pgw, 'count' => $count]);
        // $pgw = TransaksiModel::produkjointransaksi();
    }

    public function cetak_laporan_penjualan_detail()
    {
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
            )
            ->groupBy('transaksi.ID_Transaksi','transaksi.Tanggal_Transaksi','transaksi.Nama_Customer','transaksi.No_Meja')
            ->get();

        $count =  DB::table('transaksi')->count();

        $pgw = [
            'data' => $data,
            'count' => $count
        ];
        $pdf = PDF::loadView('pdf.laporan_transaksi_detail', $pgw);
        return $pdf->stream('invoice.pdf');
    }

    public function cetak_laporan_pb1_dan_biaya_service()
    {
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
            )
            ->groupBy('transaksi.ID_Transaksi','transaksi.Tanggal_Transaksi','transaksi.Nama_Customer','transaksi.No_Meja')
            ->get();

        $count =  DB::table('transaksi')->count();

        $pgw = [
            'data' => $data,
            'count' => $count
        ];
        $pdf = PDF::loadView('pdf.laporan_pajak_detail', $pgw);
        return $pdf->stream('invoice.pdf');
    }

}