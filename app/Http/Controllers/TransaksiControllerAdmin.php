<?php

namespace App\Http\Controllers;

use App\Models\TransaksiModel;
use App\Models\ProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiControllerAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // mengambil data dari table transaksi
        $pgw = TransaksiModel::produkjointransaksi();
    	// mengirim data transaksi ke view index
        return view('pages/admin/transaksi/index',['pgw' => $pgw]);
    }

    public function tambah(){
		$produk = ProdukModel::all();
        return view('pages/admin/transaksi/tambah', ['produk'=>$produk]);
    }

    public function store(Request $request){
    $barang = DB::table('produk')->where('ID_Produk', $request->id_produk)->first();
        if ($request->qty > $barang->Stok_Produk) {
            return redirect('/admin/transaksi/tambah')->withError('Stok tidak mencukupi');
        } else {
            // insert data ke table transaksi
            DB::table('transaksi')->insert([
                'Tanggal_Transaksi' => $request->tanggal_transaksi,
                'Nama_Customer' => $request->nama_customer,
                'No_Meja' => $request->no_meja,
                'ID_Produk' => $request->id_produk,
                'QTY' => $request->qty,
                'Sub_Total' => $request->sub_total,
                'PB1' => $request->pb1,
                'Biaya_Service' => $request->biaya_service,
                'Total_Pembayaran' => $request->total_pembayaran,
                'Jenis_Pembayaran' => $request->jenis_pembayaran,
                'Metode_Pembayaran' => $request->metode_pembayaran,
            ]);
            
            DB::table('produk')
            ->where('ID_Produk', $request->id_produk)
            ->update(['Stok_Produk' => DB::raw('Stok_Produk - '.$request->qty)]);
            // alihkan halaman ke halaman transaksi
	    return redirect('/admin/transaksi/')->withSuccess('Data berhasil disimpan');
        }
    }

	// method untuk hapus data transaksi
	public function hapus($id){
		// menghapus data transaksi berdasarkan id yang dipilih
		DB::table('transaksi')->where('ID_Transaksi',$id)->delete();
		
		// alihkan halaman ke halaman transaksi
		return redirect('/admin/transaksi')->withDanger('Data berhasil dihapus');
	}
}