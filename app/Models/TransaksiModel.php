<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransaksiModel extends Model
{
    use HasFactory;

    protected $table='transaksi';  
    protected $fillable=['ID_Transaksi','Tanggal_Transaksi','Nama_Customer','No_Meja','ID_Produk','QTY','Sub_Total','PB1','Biaya_Service','Total_Pembayaran','Jenis_Pembayaran','Metode_Pembayaran'];  
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'ID_Transaksi';

    public static function produkjointransaksi(){
        $brng =  DB::table('transaksi')
        ->join('produk', 'produk.ID_Produk', '=', 'transaksi.ID_Produk')
        ->get();
        return $brng;
    }
    public static function kode()
{
    $kode = DB::table('transaksi')->max('ID_Transaksi');
    $addNol = '';
    $kode = str_replace("IT-", "", $kode);
    $kode = (int) $kode + 1;
    $incrementKode = $kode;

    if (strlen($kode) == 1) {
        $addNol = "000";
    } elseif (strlen($kode) == 2) {
        $addNol = "00";
    } elseif (strlen($kode == 3)) {
        $addNol = "0";
    }

    $kodeBaru = "IT-".$addNol.$incrementKode;
    return $kodeBaru;
}

}