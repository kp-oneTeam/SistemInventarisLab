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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kodeInventaris');
            $table->unsignedBigInteger('idBarang');
            $table->unsignedBigInteger('idRuangan');
            $table->unsignedBigInteger('idVendor');
            $table->string('spesifikasi');
            $table->integer('harga');
            $table->date('tgl_pembelian');
            $table->string('kondisi');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('idBarang')->references('id')->on('barang');
            $table->foreign('idRuangan')->references('id')->on('ruangan');
            $table->foreign('idVendor')->references('id')->on('vendor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventaris');
    }
};
