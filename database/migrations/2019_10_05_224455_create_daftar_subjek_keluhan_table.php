<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarSubjekKeluhanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_subjek_keluhan', function (Blueprint $table) {
            $table->bigIncrements('id_daftar_subjek_keluhan');
            $table->bigInteger('laporan_keluhan_id')->unsigned();
            $table->bigInteger('subjek_keluhan_id')->unsigned();
            $table->timestamps();

            $table->foreign('laporan_keluhan_id')
                ->references('id_keluhan')
                ->on('laporan_keluhan')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('subjek_keluhan_id')
                ->references('id_subjek')
                ->on('subjek_keluhan')
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
        Schema::dropIfExists('daftar_subjek_keluhan');
    }
}
