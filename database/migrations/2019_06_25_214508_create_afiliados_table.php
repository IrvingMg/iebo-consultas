<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfiliadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afiliados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tabla');
            $table->text('afiliacion');
            $table->text('nombre');
            $table->integer('mvto');
            $table->text('fec_mvto');
            $table->text('curp');
            $table->text('matricula');
            $table->integer('semestre');
            $table->integer('num_p');
            $table->text('nom_p');
            $table->integer('umf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('afiliados');
    }
}
