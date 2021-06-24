<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_laporan', function (Blueprint $table) {
            $table->bigIncrements('id_log');
            $table->bigInteger('laporan_instalasi_id')->unsigned();
            $table->string('log', 255);
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
        Schema::dropIfExists('log_laporan');
    }
}
