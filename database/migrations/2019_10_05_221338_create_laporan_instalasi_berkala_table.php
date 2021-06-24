<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanInstalasiBerkalaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_instalasi_berkala', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('laporan_instalasi_id')->unsigned();
            $table->string('subjek', 50)->nullable();
            $table->string('isi_laporan', 1005);
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
        Schema::dropIfExists('laporan_instalasi_berkala');
    }
}
