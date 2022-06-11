<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Jamaah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_alamat_jamaah', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('kategori_alamat');//Sekitar Masjid / Luar Masjid
            $table->text('kategori_jamaah');//Jamaah Biasa / Donatur / Mustahik
            $table->text('nama_pemilik');
            $table->text('alamat');
            $table->integer('rt');
            $table->integer('rw');
            $table->string('penginput');
            $table->string('editor')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tb_data_jamaah', function (Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('id_alamat_jamaah');
            $table->text('nama');
            $table->string('jenis_kelamin'); //Pria & wanita
            $table->date('tanggal_lahir');
            $table->string('penginput');
            $table->string('editor')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_alamat_jamaah')->references('id')->on('tb_alamat_jamaah');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_alamat_jamaah');
        Schema::dropIfExists('tb_data_jamaah');
    }
}
