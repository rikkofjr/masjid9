<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Zakat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_zis_type', function (Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('zis_type');
            $table->timestamps();
        });

        Schema::create('tb_zis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('amil');
            $table->string('amil_editor')->nullable();
            $table->char('id_zis_type', '36');
            $table->text('atas_nama');
            $table->text('nama_lain')->nullable();
            $table->integer('jumlah_jiwa');
            $table->integer('uang')->nullable();
            $table->integer('uang_infaq')->nullable();
            $table->integer('uang_shadaqoh')->nullable();
            $table->double('beras', 8,2)->nullable();
            $table->double('beras_infaq', 8,2)->nullable();
            $table->double('beras_shadaqoh', 8,2)->nullable();
            $table->date('hijri');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_zis_type')->references('id')->on('tb_zis_type');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_zis');
    }
}
