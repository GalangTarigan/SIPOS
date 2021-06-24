<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_training', function (Blueprint $table) {
            $table->bigIncrements('id_laporan_training');
            $table->bigInteger('laporan_instalasi_id')->unsigned();
            $table->dateTime('waktu_mulai_t');
            $table->dateTime('waktu_selesai_t');
            $table->string('informasi_tambahan', 500);
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
        Schema::dropIfExists('laporan_training');
    }
}
