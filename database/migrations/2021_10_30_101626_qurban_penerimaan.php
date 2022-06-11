<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QurbanPenerimaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_qurban_penerimaan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('amil');
            $table->string('jenis_hewan');
            $table->text('atas_nama');
            $table->text('nama_lain')->nullable();
            $table->text('alamat');
            $table->text('permintaan');
            $table->string('nomor_handphone');
            $table->string('disaksikan');
            $table->text('keterangan')->nullable();
            $table->date('hijri');
            $table->string('nomor_hewan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('amil')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_qurban_penerimaan');
    }
}
