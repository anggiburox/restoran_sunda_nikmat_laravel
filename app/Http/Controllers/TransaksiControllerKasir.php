<?php

namespace App\Http\Controllers;

use App\Models\TransaksiModel;
use App\Models\TransaksiDetailModel;
use App\Models\ProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiControllerKasir extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // mengambil data dari table transaksi
        $pgw = TransaksiModel::all();
    	// mengirim data transaksi ke view index
        return view('pages/kasir/transaksi/index',['pgw' => $pgw]);
    }

    public function tambah(){
        $produk = ProdukModel::all();
        $kode = TransaksiModel::kode();
        return view('pages/kasir/transaksi/tambah', ['produk' => $produk, 'kode' => $kode]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $transaksi = new TransaksiModel();
        $transaksi->Tanggal_Transaksi = $request->tanggal_transaksi;
        $transaksi->Nama_Customer = $request->nama_customer;
        $transaksi->ID_Transaksi = $request->id_transaksi;
        $transaksi->No_Meja = $request->no_meja;
        $transaksi->Total_Pembayaran = $request->total_pembayaran;
        $transaksi->Jenis_Pembayaran = $request->jenis_pembayaran;
        $transaksi->Metode_Pembayaran = $request->metode_pembayaran;
        $transaksi->save();

        $id_produk = $request->id_produk;
        $hrg = $request->hrg;
        $totsub = $request->totsub;
        $tarif_biaya_service = $request->tarif_biaya_service;
        $qty = $request->qty;
        $dpp = $request->dpp;
        $ser = $request->ser;
        $pb = $request->pb;
        $totbp = $request->totbp;
        $total_sub = $request->total_sub_total;

        foreach ($id_produk as $key => $value) {
            
            $detail = new TransaksiDetailModel();
            $detail->ID_Transaksi = $request->id_transaksi; // Assuming you have a foreign key to the transaksi table
            $detail->ID_Produk = $id_produk[$key];
            $detail->Sub_Total = $totsub[$key];
            $detail->QTY = $qty[$key];
            $detail->Tarif_Biaya_Service = $tarif_biaya_service[$key];
            $detail->Biaya_Service = $ser[$key];
            $detail->DPP = $dpp[$key];
            $detail->BP = $pb[$key];
            $detail->Biaya_BP = $totbp[$key];
            $detail->Total = $total_sub[$key];
            $detail->save();

            DB::table('produk')
            ->where('ID_Produk', $id_produk[$key]) // Corrected the usage of $id_produk[$key]
            ->update(['Stok_Produk' => DB::raw('Stok_Produk - ' . $qty[$key])]);

        }
        
        return redirect('/kasir/transaksi/')->withSuccess('Data berhasil disimpan');
        
    }

	 // method untuk hapus data transaksi
     public function hapus($id)
     {
         // menghapus data transaksi berdasarkan id yang dipilih
         DB::table('transaksi')->where('ID_Transaksi', $id)->delete();
         DB::table('transaksi_detail')->where('ID_Transaksi', $id)->delete();
 
         // alihkan halaman ke halaman transaksi
         return redirect('/kasir/transaksi')->withDanger('Data berhasil dihapus');
     }
     public function detail($id){
         $data = DB::table('transaksi')
         ->join('transaksi_detail','transaksi_detail.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
         ->join('produk','produk.ID_produk', '=', 'transaksi_detail.ID_produk')
         ->where('transaksi.ID_Transaksi',$id)
         ->get();
         // dd($data);
 
         return response()->json($data);
     }
}