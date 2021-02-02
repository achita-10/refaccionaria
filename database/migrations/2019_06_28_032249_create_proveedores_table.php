<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            //el id de proveedores es llave foranea
            //a partir de laravel 5.8 se debe especificar la llavel primaria como bigIncrements y
            // la llave foranea como bigInteger
            $table->bigInteger('id')->unsigned();
            $table->string('Contacto',50)->nullable();
            $table->string('Telefono_Contacto',50)->nullable();
            //No se agregan los campos timestamps, por que no se van a implementar las funciones registrar y actualizar
            //$table->timestamps();
            //Se especifican las llaves foraneas
            //se dice que el id de la tabla proveedores es foranea del id de la tabla personas
            $table->foreign('id')->references('id')->on('Personas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
