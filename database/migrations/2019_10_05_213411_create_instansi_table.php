<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstansiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instansi', function (Blueprint $table) {
            $table->bigIncrements('id_instansi');
            $table->string('nama_instansi', 50);
            $table->string('kategori', 20);
            $table->string('provinsi', 50);
            $table->string('kabupaten_kota', 50);
            $table->string('alamat_instansi', 50);
            $table->string('email', 50)->nullable();
            $table->string('no_telepon', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instansi');
    }
}
