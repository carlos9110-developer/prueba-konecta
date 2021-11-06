<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulosRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulos_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rol');
            $table->unsignedBigInteger('id_modulo');
            $table->foreign('id_rol')->references('id')->on('roles');
            $table->foreign('id_modulo')->references('id')->on('modulos');
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
        Schema::dropIfExists('modulos_roles');
    }
}
