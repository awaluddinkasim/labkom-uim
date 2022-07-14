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
        Schema::create('slip', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_praktikum');
            $table->string('nim');
            $table->string('nama_mhs');
            $table->string('slip');
            $table->date('tgl_slip');
            $table->integer('nominal');
            $table->timestamps();

            $table->foreign('id_praktikum')->references('id')->on('praktikum')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slip');
    }
};
