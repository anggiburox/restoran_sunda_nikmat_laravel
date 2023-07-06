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
        Schema::create('produk_masuk', function (Blueprint $table) {
            $table->id('ID_Produk_Masuk');
            $table->string('ID_Produk', 20);
            $table->integer('Jumlah_Produk_Masuk');
            $table->date('Tanggal_Produk_Masuk');
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
        Schema::dropIfExists('produk_masuk');
    }
};
