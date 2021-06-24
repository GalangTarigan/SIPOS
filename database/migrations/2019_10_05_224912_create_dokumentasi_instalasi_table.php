<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokumentasiInstalasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumentasi_instalasi', function (Blueprint $table) {
            $table->bigIncrements('id_dokumen');
            $table->uuid('uuid');
            $table->bigInteger('laporan_instalasi_id')->unsigned();
            $table->string('keterangan', 50);
            $table->string('dokumentasi', 255);
            $table->timestamps();

            $table->foreign('laporan_instalasi_id')
                ->references('id_laporan')
                ->on('laporan_instalasi')
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
        Schema::dropIfExists('dokumentasi_instalasi');
    }
}
