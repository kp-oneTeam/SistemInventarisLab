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
        Schema::create('spesifikasi_komputer', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("idInventaris");
            $table->unsignedInteger("idInventarisKomputer");
            $table->timestamps();

            $table->foreign('idInventaris')->references('id')->on('inventaris');
            $table->foreign('idInventarisKomputer')->references('id')->on('inventaris_komputer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spesifikasi_komputer');
    }
};
