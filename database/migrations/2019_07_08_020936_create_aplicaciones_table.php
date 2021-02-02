<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAplicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ID_Articulo')->unsigned();
            $table->foreign('ID_Articulo')->references('id')->on('Articulos');
            $table->string('Modelo',100);
            $table->string('Ano',20);
            $table->string('Motor',100);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aplicaciones');
    }
}
