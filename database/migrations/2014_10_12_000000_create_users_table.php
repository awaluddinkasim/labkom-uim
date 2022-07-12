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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('no_hp');
            $table->string('password');
            $table->string('foto')->default('default.png');
            $table->foreignId('id_jurusan');
            $table->enum('active', ['0', '1'])->default('0');
            $table->enum('level', ['asisten', 'mahasiswa'])->default('mahasiswa');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_jurusan')->references('id')->on('jurusan')
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
        Schema::dropIfExists('users');
    }
};
