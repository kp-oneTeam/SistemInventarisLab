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
        Schema::create('inventaris_storage', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('kodeInventaris')->unique();
            $table->unsignedBigInteger('idRuangan');
            $table->unsignedBigInteger('idVendor');
            $table->string('nama_storage');
            $table->string('jenis_storage');
            $table->string('kapasitas_storage');
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
        Schema::dropIfExists('inventaris_storages');
    }
};
