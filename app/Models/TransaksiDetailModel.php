<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetailModel extends Model
{
    use HasFactory;

    protected $table='transaksi_detail';  
    protected $fillable=[
       
        'ID_Transaksi',
        'ID_Produk',
        'QTY',
        'Sub_Total',
        'Tarif_Biaya_Service',
        'Biaya_Service',
        'DPP',
        'BP',
        'Biaya_BP',
        'Total',  
    ];  
    public $timestamps = false;
    public $incrementing = true;
    protected $primaryKey = 'ID_Transaksi_Detail';
}
