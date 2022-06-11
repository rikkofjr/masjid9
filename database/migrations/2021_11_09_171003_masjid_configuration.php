<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasjidConfiguration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_masjid_info', function (Blueprint $table) {
            $table->id();
            $table->text('nama_masjid')->nullable();
            $table->text('alamat')->nullable();
            $table->text('nomor_telepon')->nullable();
            $table->text('nomor_handphone')->nullable();
            $table->text('email')->nullable();
            $table->string('user_update');
            $table->timestamps();

            $table->foreign('user_update')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_masjid_info');
    }
}
