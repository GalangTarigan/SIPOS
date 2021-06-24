<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanInstalasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_instalasi', function (Blueprint $table) {
            $table->bigIncrements('id_laporan');
            $table->string('user_nama', 50);
            $table->uuid('uuid')->unique();
            $table->bigInteger('user_id');
            $table->bigInteger('instansi_id')->unsigned();
            $table->timestamp('waktu_mulai');
            $table->timestamp('waktu_selesai')->nullable();
            $table->string('status', 20);
            $table->timestamps();

            $table->foreign('instansi_id')
                ->references('id_instansi')
                ->on('instansi')
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
        Schema::dropIfExists('laporan_instalasi');
    }
}
