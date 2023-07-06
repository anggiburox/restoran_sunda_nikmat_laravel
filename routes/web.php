<?php

use Illuminate\Support\Facades\Route;

//admin
use App\Http\Controllers\DashboardControllerAdmin;
use App\Http\Controllers\ProdukControllerAdmin;
use App\Http\Controllers\ProdukMasukControllerAdmin;

//kasir
use App\Http\Controllers\DashboardControllerKasir;

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
    Route::get('/admin/produk_masuk/edit/{id}',[ProdukMasukControllerAdmin::class, 'edit']);
    Route::post('/admin/produk_masuk/update',[ProdukMasukControllerAdmin::class, 'update']);
    Route::get('/admin/produk_masuk/hapus/{id}',[ProdukMasukControllerAdmin::class, 'hapus']);
    