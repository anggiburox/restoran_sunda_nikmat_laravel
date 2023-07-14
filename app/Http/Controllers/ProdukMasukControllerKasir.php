<?php

namespace App\Http\Controllers;

use App\Models\ProdukModel;
use App\Models\ProdukMasukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukMasukControllerKasir extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // mengambil data dari table barang
        $pgw = ProdukMasukModel::produkjoinprodukmasuk();
    	// mengirim data barang ke view index
        return view('pages/kasir/produk_masuk/index',['pgw' => $pgw]);
    }

    public function tambah(){
		$produk = ProdukModel::all();
        return view('pages/kasir/produk_masuk/tambah', ['produk'=>$produk]);
    }

    public function store(Request $request){
	// insert data ke table barang
	DB::table('produk_masuk')->insert([
		'ID_Produk' => $request->id_produk,
        'Jumlah_Produk_Masuk' => $request->jumlah_produk_masuk,
        'Tanggal_Produk_Masuk' => $request->tanggal_produk_masuk
	]);
    
    DB::table('produk')
    ->where('ID_Produk', $request->id_produk)
    ->update(['Stok_Produk' => DB::raw('Stok_Produk + '.$request->jumlah_produk_masuk)]);
	// alihkan halaman ke halaman barang
	return redirect('/kasir/produk_masuk/')->withSuccess('Data berhasil disimpan');
    }
    
	// method untuk hapus data barang
	public function hapus($id)
{
    // menghapus data barang masuk berdasarkan id yang dipilih
    $barangMasuk = ProdukMasukModel::findOrFail($id);
    $barangMasuk->delete();
    
    // alihkan halaman ke halaman barang masuk
    return redirect('/kasir/produk_masuk')->withDanger('Data berhasil dihapus');
}

}