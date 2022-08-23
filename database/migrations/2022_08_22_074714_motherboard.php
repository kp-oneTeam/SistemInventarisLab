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
        Schema::create('inventaris_motherboard', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('kodeInventaris')->unique();
            $table->unsignedBigInteger('idRuangan');
            $table->unsignedBigInteger('idVendor');
            $table->string('namaMotherboard');
            $table->string('chipsetMotherboard');
            $table->string('socketMotherboard');
            $table->integer('memoriSlot');
            $table->string('memoriSupport');
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
        Schema::dropIfExists('motherboard');
    }
};