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
        Schema::create('inventaris_gpu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kodeInventaris')->unique();
            $table->unsignedInteger('idRuangan');
            $table->unsignedInteger('idVendor');
            $table->string('namaGpu');
            $table->string('ukuranMemori');
            $table->string('memoriInterface');
            $table->string('kecepatanMemori');
            $table->string('tipeMemori');
            $table->integer('hargaGpu');
            $table->date('tglPembelianGpu');
            $table->string('kondisiGpu');
            $table->string('keteranganGpu')->nullable();
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
        Schema::dropIfExists('inventaris_gpu');
    }
};
