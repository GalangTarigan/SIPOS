<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarPicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_pic', function (Blueprint $table) {
            $table->bigIncrements('id_pic');
            $table->bigInteger('instansi_id')->unsigned();
            $table->string('nama_pic', 50);
            $table->string('kontak_pic', 20);
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
        Schema::dropIfExists('daftar_pic');
    }
}
