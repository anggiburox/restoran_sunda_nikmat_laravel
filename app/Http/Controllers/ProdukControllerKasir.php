<?php

namespace App\Http\Controllers;

use App\Models\ProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukControllerKasir extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // mengambil data dari table produk
        $pgw = DB::table('produk')->get();
    	// mengirim data produk ke view index
        return view('pages/kasir/produk/index',['pgw' => $pgw]);
    }

    public function tambah(){
		$kode = ProdukModel::kode();
        return view('pages/kasir/produk/tambah', ['kode'=>$kode]);
    }

    public function store(Request $request){
	// insert data ke table produk
	DB::table('produk')->insert([
		'ID_Produk' => $request->id_produk,
        'Nama_Produk' => $request->nama_produk,
        'Stok_Produk' => $request->stok_produk,
        'Harga_Satuan_Produk' => $request->harga_satuan_produk
	]);
	// alihkan halaman ke halaman produk
	return redirect('/kasir/produk/')->withSuccess('Data berhasil disimpan');
    }

    public function edit($id)
	{
		// mengambil data produk berdasarkan id yang dipilih
		$pgw = DB::table('produk')->where('ID_Produk',$id)->get();
		// passing data produk yang didapat ke view edit.blade.php
		return view('pages/kasir/produk/edit',['pgw' => $pgw]);
	}

	// update data produk
	public function update(Request $request){
		// update data produk
		DB::table('produk')->where('ID_Produk',$request->id_produk)->update([
            'Nama_Produk' => $request->nama_produk,
            'Stok_Produk' => $request->stok_produk,
            'Harga_Satuan_Produk' => $request->harga_satuan_produk
		]);
		// alihkan halaman ke halaman produk
		return redirect('/kasir/produk')->withSuccess('Data berhasil diperbaharui');
	}

	// method untuk hapus data produk
	public function hapus($id){
		// menghapus data produk berdasarkan id yang dipilih
		DB::table('produk')->where('ID_Produk',$id)->delete();
		
		// alihkan halaman ke halaman produk
		return redirect('/kasir/produk')->withDanger('Data berhasil dihapus');
	}
}