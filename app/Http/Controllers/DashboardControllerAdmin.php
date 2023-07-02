<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\BarangMasukModel;
use App\Models\CustomerModel;
use App\Models\SalesModel;
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
        // $barangall = BarangModel::all();
        // $barang = BarangModel::count();
        // $barang_masukall = BarangMasukModel::barangjoinbarangmasuk();
        // $barang_masuk = BarangMasukModel::count();
        // $customerall = CustomerModel::all();
        // $customer = CustomerModel::count();
        // $sales = SalesModel::count();
        // $salesall = SalesModel::salesjoinbarangcustomer();
        // $data = SalesModel::select(DB::raw('DATE_FORMAT(Tanggal_Transaksi, "%Y-%m") as bulan'),DB::raw('SUM(replace(replace(Harga_Sales,"Rp.",""),".","")) as total'))
        //     ->groupBy(DB::raw('DATE_FORMAT(Tanggal_Transaksi, "%Y-%m")'))
        //     ->paginate(5);

        return view('pages/admin/dashboard'
        // , ['barang'=>$barang, 'barang_masuk'=>$barang_masuk, 'customer'=>$customer, 'sales'=>$sales, 'barangall'=>$barangall, 'customerall'=>$customerall, 'barang_masukall'=>$barang_masukall, 'salesall'=>$salesall], compact('data')
    );
    }
}