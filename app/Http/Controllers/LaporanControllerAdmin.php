<?php

namespace App\Http\Controllers;

use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanControllerAdmin extends Controller
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
        return view('pages/admin/laporan/index', ['pgw' => $pgw]);
    }

    public function laporan_data_transaksi()
    {
        $pgw =  DB::table('transaksi')
            ->join('transaksi_detail', 'transaksi_detail.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
            ->join('produk', 'produk.ID_produk', '=', 'transaksi_detail.ID_produk')
            ->get();
            $count =  DB::table('transaksi')->count();
            
        
        return view('pages/admin/laporan/laporan_data_transaksi', ['pgw' => $pgw, 'count'=>$count]);
    }

    public function laporan_penjualan_detail()
    {

        $pgw =  DB::table('transaksi')
        ->join('transaksi_detail', 'transaksi_detail.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
        ->join('produk', 'produk.ID_produk', '=', 'transaksi_detail.ID_produk')
        ->get();
        $count =  DB::table('transaksi')->count();
        
    
        return view('pages/admin/laporan/laporan_penjualan_detail', ['pgw' => $pgw, 'count'=>$count]);
        // $pgw = TransaksiModel::produkjointransaksi();
    }

    public function laporan_pb1_dan_biaya_service()
    {

        $pgw =  DB::table('transaksi')
        ->join('transaksi_detail', 'transaksi_detail.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
        ->join('produk', 'produk.ID_produk', '=', 'transaksi_detail.ID_produk')
        ->get();
        $count =  DB::table('transaksi')->count();
        
    
        return view('pages/admin/laporan/laporan_pb1_dan_biaya_service', ['pgw' => $pgw, 'count'=>$count]);
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


    public function cetak_laporan_penjualan_detail()
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
        $pdf = PDF::loadView('pdf.laporan_transaksi_detail', $pgw);
        return $pdf->stream('invoice.pdf');
    }

    public function cetak_laporan_pb1_dan_biaya_service()
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
    $pdf = PDF::loadView('pdf.laporan_', $pgw);
    return $pdf->stream('invoice.pdf');
    }
}
