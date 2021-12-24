<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanandetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanandetails', function (Blueprint $table) {
            $table->id('id_pesanandetail');
            $table->foreignId('pesanan_id');
            $table->foreignId('barang_id');
            $table->integer('jumlah_barang')->unsigned();
            $table->string('jumlah_harga', 20);
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
        Schema::dropIfExists('pesanandetails');
    }
}
