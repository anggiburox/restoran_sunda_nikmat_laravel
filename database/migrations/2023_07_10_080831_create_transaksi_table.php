<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('ID_Transaksi');
            $table->date('Tanggal_Transaksi');
            $table->string('Nama_Customer', 20);
            $table->integer('No_Meja');
            $table->string('ID_Produk', 20);
            $table->integer('Sub_Total');
            $table->string('PB1',10);
            $table->string('Biaya_Service',10);
            $table->string('Total_Pembayaran',50);
            $table->string('Jenis_Pembayaran',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};