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
            $table->string('ID_Transaksi',20)->primary();
            $table->date('Tanggal_Transaksi')->nullable();
            $table->string('Nama_Customer', 20)->nullable();
            $table->integer('No_Meja')->nullable();
            $table->string('ID_Produk', 20)->nullable();
            $table->integer('QTY')->nullable();
            $table->string('Sub_Total',50)->nullable();
            $table->string('PB1',10)->nullable();
            $table->string('Biaya_Service',10)->nullable();
            $table->string('Total_Pembayaran',50)->nullable();
            $table->string('Jenis_Pembayaran',50)->nullable();
            $table->string('Metode_Pembayaran',50)->nullable();
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