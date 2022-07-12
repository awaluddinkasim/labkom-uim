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
        Schema::create('pengampuh_matkul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dosen');
            $table->foreignId('id_matkul');
            $table->timestamps();

            $table->foreign('id_dosen')->references('id')->on('dosens')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_matkul')->references('id')->on('matkul')
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
        Schema::dropIfExists('pengampuh_matkul');
    }
};
