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
            $table->string('kodeInventaris');
            $table->string('kodeBarang');
            $table->string('kodeRuangan');
            $table->string('kodeVendor');
            $table->string('spesifikasi');
            $table->integer('harga');
            $table->date('tgl_pembelian');
            $table->string('kondisi');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('kodeBarang')->references('kodeBarang')->on('barang');
            $table->foreign('kodeRuangan')->references('kodeRuangan')->on('ruangan');
            $table->foreign('kodeVendor')->references('kodeVendor')->on('vendor');
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
