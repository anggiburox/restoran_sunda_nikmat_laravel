<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth;

//admin
use App\Http\Controllers\DashboardControllerAdmin;
use App\Http\Controllers\LaporanControllerAdmin;
use App\Http\Controllers\ProdukControllerAdmin;
use App\Http\Controllers\ProdukMasukControllerAdmin;
use App\Http\Controllers\ProfileControllerAdmin;
use App\Http\Controllers\TransaksiControllerAdmin;
use App\Http\Controllers\UsersControllerAdmin;

//kasir
use App\Http\Controllers\DashboardControllerKasir;
use App\Http\Controllers\ProdukControllerKasir;
use App\Http\Controllers\ProdukMasukControllerKasir;
use App\Http\Controllers\ProfileControllerKasir;
use App\Http\Controllers\TransaksiControllerKasir;

//spv_owner
use App\Http\Controllers\DashboardControllerSPVOwner;
use App\Http\Controllers\LaporanControllerSPVOwner;
use App\Http\Controllers\ProfileControllerSPVOwner;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [Auth::class, 'index'])->name('login');
Route::post('/login', [Auth::class, 'login']);
Route::get('/logout', [Auth::class, 'logout']);


Route::post('/auth/loginforgot/updatelupapassword/',[Auth::class, 'updatelupapassword']);


Route::middleware(['auth','admin'])->group(function () {
    //route admin users
    Route::get('/admin/dashboard/', [DashboardControllerAdmin::class, 'index']);

    Route::get('/admin/profile', [ProfileControllerAdmin::class, 'index']);
    Route::post('/admin/profile/{id}',[ProfileControllerAdmin::class, 'editprofile']);

    //route admin users
    Route::get('/admin/users/', [UsersControllerAdmin::class, 'index']);
    Route::get('/admin/users/tambah', [UsersControllerAdmin::class, 'tambah']);
    Route::post('/admin/users/store', [UsersControllerAdmin::class, 'store']);
    Route::get('/admin/users/edit/{id}',[UsersControllerAdmin::class, 'edit']);
    Route::post('/admin/users/update',[UsersControllerAdmin::class, 'update']);
    Route::get('/admin/users/hapus/{id}',[UsersControllerAdmin::class, 'hapus']);

    //route admin produk
    Route::get('/admin/produk/', [ProdukControllerAdmin::class, 'index']);
    Route::get('/admin/produk/tambah', [ProdukControllerAdmin::class, 'tambah']);
    Route::post('/admin/produk/store', [ProdukControllerAdmin::class, 'store']);
    Route::get('/admin/produk/edit/{id}',[ProdukControllerAdmin::class, 'edit']);
    Route::post('/admin/produk/update',[ProdukControllerAdmin::class, 'update']);
    Route::get('/admin/produk/hapus/{id}',[ProdukControllerAdmin::class, 'hapus']);

    //route admin produk masuk
    Route::get('/admin/produk_masuk/', [ProdukMasukControllerAdmin::class, 'index']);
    Route::get('/admin/produk_masuk/tambah', [ProdukMasukControllerAdmin::class, 'tambah']);
    Route::post('/admin/produk_masuk/store', [ProdukMasukControllerAdmin::class, 'store']);
    Route::get('/admin/produk_masuk/hapus/{id}',[ProdukMasukControllerAdmin::class, 'hapus']);

    //route admin transaksi
    Route::get('/admin/transaksi/', [TransaksiControllerAdmin::class, 'index']);
    Route::get('/admin/transaksi/tambah', [TransaksiControllerAdmin::class, 'tambah']);
    Route::post('/admin/transaksi/store', [TransaksiControllerAdmin::class, 'store']);
    Route::get('/admin/transaksi/hapus/{id}',[TransaksiControllerAdmin::class, 'hapus']);
    Route::get('/admin/transaksi/detail/{id}',[TransaksiControllerAdmin::class, 'detail']);

    //route admin laporan
    Route::get('/admin/laporan/', [LaporanControllerAdmin::class, 'index']);
    Route::get('/admin/laporan/laporan_penjualan_detail', [LaporanControllerAdmin::class, 'laporan_penjualan_detail']);
    Route::get('/admin/laporan/laporan_pajak_restoran', [LaporanControllerAdmin::class, 'laporan_pajak_restoran']);
    Route::get('/admin/laporan/laporan_biaya_service', [LaporanControllerAdmin::class, 'laporan_biaya_service']);
    Route::get('/admin/laporan/cetak/laporan_penjualan_detail', [LaporanControllerAdmin::class, 'cetak_laporan_penjualan_detail']);
});

Route::middleware(['auth','spv_owner'])->group(function () {
    //route spv_owner users
    Route::get('/spv_owner/dashboard/', [DashboardControllerSPVOwner::class, 'index']);

    Route::get('/spv_owner/profile', [ProfileControllerSPVOwner::class, 'index']);
    Route::post('/spv_owner/profile/{id}',[ProfileControllerSPVOwner::class, 'editprofile']);

    //route spv_owner laporan
    Route::get('/spv_owner/laporan/', [LaporanControllerSPVOwner::class, 'index']);
    Route::get('/spv_owner/laporan/laporan_penjualan_detail', [LaporanControllerSPVOwner::class, 'laporan_penjualan_detail']);
    Route::get('/spv_owner/laporan/laporan_pajak_restoran', [LaporanControllerSPVOwner::class, 'laporan_pajak_restoran']);
    Route::get('/spv_owner/laporan/laporan_biaya_service', [LaporanControllerSPVOwner::class, 'laporan_biaya_service']);
});

Route::middleware(['auth','kasir'])->group(function () {
    //route kasir users
    Route::get('/kasir/dashboard/', [DashboardControllerKasir::class, 'index']);

    Route::get('/kasir/profile', [ProfileControllerKasir::class, 'index']);
    Route::post('/kasir/profile/{id}',[ProfileControllerKasir::class, 'editprofile']);

    //route kasir produk
    Route::get('/kasir/produk/', [ProdukControllerKasir::class, 'index']);
    Route::get('/kasir/produk/tambah', [ProdukControllerKasir::class, 'tambah']);
    Route::post('/kasir/produk/store', [ProdukControllerKasir::class, 'store']);
    Route::get('/kasir/produk/edit/{id}',[ProdukControllerKasir::class, 'edit']);
    Route::post('/kasir/produk/update',[ProdukControllerKasir::class, 'update']);
    Route::get('/kasir/produk/hapus/{id}',[ProdukControllerKasir::class, 'hapus']);

    //route kasir produk masuk
    Route::get('/kasir/produk_masuk/', [ProdukMasukControllerKasir::class, 'index']);
    Route::get('/kasir/produk_masuk/tambah', [ProdukMasukControllerKasir::class, 'tambah']);
    Route::post('/kasir/produk_masuk/store', [ProdukMasukControllerKasir::class, 'store']);
    Route::get('/kasir/produk_masuk/hapus/{id}',[ProdukMasukControllerKasir::class, 'hapus']);

    //route kasir transaksi
    Route::get('/kasir/transaksi/', [TransaksiControllerKasir::class, 'index']);
    Route::get('/kasir/transaksi/tambah', [TransaksiControllerKasir::class, 'tambah']);
    Route::post('/kasir/transaksi/store', [TransaksiControllerKasir::class, 'store']);
    Route::get('/kasir/transaksi/hapus/{id}',[TransaksiControllerKasir::class, 'hapus']);
});


    