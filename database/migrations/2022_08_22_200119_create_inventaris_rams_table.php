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
            $table->string('namaMemory');
            $table->string('jenisMemory');
            $table->string('tipeMemory');
            $table->string('kapasitasMemory');
            $table->string('frekuensiMemory');
            $table->integer('harga');
            $table->date('tglPembelian');
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
