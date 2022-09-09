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
            $table->increments('id');
            $table->string('kodeInventarisKomputer');
            $table->unsignedInteger('idRuangan');
            $table->unsignedInteger('idInventarisMotherboard');
            $table->unsignedInteger('idInventarisProcessor');
            $table->unsignedInteger('idInventarisGpu');
            $table->unsignedInteger('idInventarisPsu');
            $table->unsignedInteger('idInventarisCasing');
            $table->string('tanggal_perakitan');
            $table->string('kondisi');
            $table->text('keterangan');

            $table->timestamps();
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
        Schema::dropIfExists('inventaris_komputer');
    }
};
