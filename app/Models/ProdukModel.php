<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProdukModel extends Model
{
    use HasFactory;

    protected $table='produk';  
    protected $fillable=['ID_Produk','Nama_Produk','Stok_Produk','Harga_Satuan_Produk'];  
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'ID_Produk';

    public static function kode()
{
    $kode = DB::table('produk')->max('ID_Produk');
    $addNol = '';
    $kode = str_replace("IP-", "", $kode);
    $kode = (int) $kode + 1;
    $incrementKode = $kode;

    if (strlen($kode) == 1) {
        $addNol = "000";
    } elseif (strlen($kode) == 2) {
        $addNol = "00";
    } elseif (strlen($kode == 3)) {
        $addNol = "0";
    }

    $kodeBaru = "IP-".$addNol.$incrementKode;
    return $kodeBaru;
}

}