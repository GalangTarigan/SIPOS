<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanKeluhanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_keluhan', function (Blueprint $table) {
            $table->bigIncrements('id_keluhan');
            $table->uuid('uuid')->unique();
            $table->bigInteger('pelapor_id')->unsigned();
            $table->bigInteger('instansi_id')->unsigned();
            $table->timestamp('waktu_lapor_keluhan')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->timestamp('waktu_selesai_penanganan')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->string('permasalahan', 500);
            $table->string('solusi', 500);
            $table->string('nama_teknisi', 50);
            $table->timestamps();

            $table->foreign('pelapor_id')
                ->references('id_pic')
                ->on('daftar_pic')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('laporan_keluhan');
    }
}
