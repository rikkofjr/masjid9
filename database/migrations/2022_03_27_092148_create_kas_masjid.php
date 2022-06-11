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
        Schema::create('tb_kas_transaksi_kategori', function (Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('cat_transaksi');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tb_kas_transaksi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('jenis');
            $table->uuid('cat_transaksi_id');
            $table->text('nama_transaksi');
            $table->text('catatan')->nullable();
            $table->bigInteger('debit')->nullable();
            $table->bigInteger('kredit')->nullable();
            $table->uuid('penginput');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cat_transaksi_id')->references('id')->on('tb_kas_transaksi_kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kas_transaksi_kategori');
        Schema::dropIfExists('tb_kas_transaksi');
    }
};
