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
        Schema::create('inventaris_processor', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kodeInventaris')->unique();
            $table->unsignedInteger('idRuangan');
            $table->unsignedInteger('idVendor');
            $table->string('nama_processor');
            $table->string('nomor_processor');
            $table->string('generasi');
            $table->string('series');
            $table->string('kecepatan');
            $table->string('jumlah_core');
            $table->string('jumlah_thread');
            $table->string('socket');
            $table->integer('harga');
            $table->date('tgl_pembelian');
            $table->string('kondisi');
            $table->string('keterangan')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('processors');
    }
};
