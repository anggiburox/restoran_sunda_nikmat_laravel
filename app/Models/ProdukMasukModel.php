<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProdukMasukModel extends Model
{
    use HasFactory;

    protected $table='produk_masuk';  
    protected $fillable=['ID_Produk_Masuk','ID_Produk','Jumlah_Produk_Masuk','Tanggal_Produk_Masuk'];  
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'ID_Produk_Masuk';

    public static function produkjoinprodukmasuk(){
        $brng =  DB::table('produk_masuk')
        ->join('produk', 'produk.ID_Produk', '=', 'produk_masuk.ID_Produk')
        ->get();
        return $brng;
    }

    protected static function boot()
{
    parent::boot();

    static::deleted(function ($barangMasuk) {
        DB::table('produk')
            ->where('ID_Produk', $barangMasuk->ID_Produk)
            ->decrement('Stok_Produk', $barangMasuk->Jumlah_Produk_Masuk);
    });
}

}