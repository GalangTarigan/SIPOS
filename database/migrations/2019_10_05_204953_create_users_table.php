<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_lengkap', 50);
            $table->uuid('uuid');
            $table->string('email', 50)->unique();
            $table->string('role', 50)->default('default');
            $table->tinyInteger('verified')->default(0);
            $table->string('password', 255);
            $table->string('no_telepon', 50);
            $table->string('alamat', 50)->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('remember_token', 100)->nullable();
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
        Schema::dropIfExists('users');
    }
}
