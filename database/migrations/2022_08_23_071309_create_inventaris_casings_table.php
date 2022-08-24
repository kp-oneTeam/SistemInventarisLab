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
        Schema::create('inventaris_casing', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('kodeInventaris')->unique();
            $table->unsignedBigInteger('idRuangan');
            $table->unsignedBigInteger('idVendor');
            $table->string('namaCasing');
            $table->string('formFactor');
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
        Schema::dropIfExists('inventaris_casings');
    }
};
