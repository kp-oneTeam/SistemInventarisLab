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
        Schema::create('inventaris_komputer', function (Blueprint $table) {
            $table->id();
            $table->string('kodeInventarisKomputer');
            $table->unsignedBigInteger('idBarang');
            $table->unsignedBigInteger('idRuangan');
            $table->string('tanggal_perakitan');
            $table->string('kondisi');
            $table->text('keterangan');

            $table->timestamps();
            $table->foreign('idBarang')->references('id')->on('barang');
            $table->foreign('idRuangan')->references('id')->on('ruangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invetaris_komputers');
    }
};
