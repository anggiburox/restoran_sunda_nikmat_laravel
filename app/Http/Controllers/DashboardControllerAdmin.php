<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\ProdukModel;
use App\Models\ProdukMasukModel;
use App\Models\TransaksiModel;
use Illuminate\Support\Facades\DB;

class DashboardControllerAdmin extends Controller
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
        return view('pages/admin/dashboard', [
            'users'=>$users, 
            'produk'=>$produk,
            'produk_masuk'=>$produk_masuk,
            'transaksi'=>$transaksi,
        ]);
    }
}