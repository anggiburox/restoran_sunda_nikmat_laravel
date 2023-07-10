<?php

namespace App\Http\Controllers;

use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
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
        return view('pages/admin/laporan/index',['pgw' => $pgw]);
    }
    
    public function laporan_penjualan_detail(){
        $pgw = TransaksiModel::produkjointransaksi();
        return view('pages/admin/laporan/laporan_penjualan_detail', ['pgw'=>$pgw]);
    }

    public function laporan_pajak_restoran(){
        $pgw = TransaksiModel::produkjointransaksi();
        return view('pages/admin/laporan/laporan_pajak_restoran', ['pgw'=>$pgw]);
    }

    public function laporan_biaya_service(){
        $pgw = TransaksiModel::produkjointransaksi();
        return view('pages/admin/laporan/laporan_biaya_service', ['pgw'=>$pgw]);
    }
}