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
        Schema::create('inventaris_ram', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kodeInventaris')->unique();
            $table->unsignedInteger('idRuangan');
            $table->unsignedInteger('idVendor');
            $table->string('nama_memory');
            $table->string('jenis_memory');
            $table->string('tipe_memory');
            $table->string('kapasitas_memory');
            $table->string('frekuensi_memory');
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
        Schema::dropIfExists('inventaris_ram');
    }
};
