<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LaporanController;

//admin
use App\Http\Controllers\DashboardControllerAdmin;
use App\Http\Controllers\ProdukControllerAdmin;
use App\Http\Controllers\ProdukMasukControllerAdmin;
use App\Http\Controllers\TransaksiControllerAdmin;
use App\Http\Controllers\UsersControllerAdmin;

//kasir
use App\Http\Controllers\DashboardControllerKasir;
use App\Http\Controllers\TransaksiControllerKasir;

//spv_owner
use App\Http\Controllers\DashboardControllerSPVOwner;

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



//route admin dashboard
Route::get('/', [DashboardControllerAdmin::class, 'index']);

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

    //route admin laporan
    Route::get('/admin/laporan/', [LaporanController::class, 'index']);
    Route::get('/admin/laporan/laporan_penjualan_detail', [LaporanController::class, 'laporan_penjualan_detail']);
    Route::get('/admin/laporan/laporan_pajak_restoran', [LaporanController::class, 'laporan_pajak_restoran']);
    Route::get('/admin/laporan/laporan_biaya_service', [LaporanController::class, 'laporan_biaya_service']);
    