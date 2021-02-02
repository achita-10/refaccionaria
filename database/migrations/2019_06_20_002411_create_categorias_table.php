<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre',50);
            //El metodo nullable sirve para que el campo acepte un valor nulo osea que no reciba un valor
            $table->string('Descripcion',256)->nullable();
            //el metodo default() sirve para cuando se haga un registro con valor por defecto tendra el que se defina en el metodo
            $table->boolean('Condicion')->default(1);
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
        Schema::dropIfExists('categorias');
    }
}
