<?php

use Illuminate\Support\Facades\Route;

//admin
use App\Http\Controllers\DashboardControllerAdmin;

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