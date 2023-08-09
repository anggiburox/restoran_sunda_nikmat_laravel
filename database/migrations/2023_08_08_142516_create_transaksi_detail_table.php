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
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->id('ID_Transaksi_Detail');
            $table->string('ID_Transaksi', 10)->nullable();
            $table->string('ID_Produk', 20)->nullable();
            $table->integer('QTY')->nullable();
            $table->string('Sub_Total', 500)->nullable();
            $table->string('Tarif_Biaya_Service', 500)->nullable();
            $table->string('Biaya_Service', 100)->nullable();
            $table->string('DPP', 100)->nullable();
            $table->string('BP', 100)->nullable();
            $table->string('Biaya_BP', 100)->nullable();
            $table->string('Total', 100)->nullable();
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
        Schema::dropIfExists('transaksi_detail');
    }
};
