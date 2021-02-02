<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            //Definición de llave foranea. a partir de la -v 5.8 Laravel se debe especificar
            //bigInteger a las llaves foraneas
            $table->bigInteger('ID_Categoria')->unsigned();
            //Acepta valores nulos
            $table->string('Codigo',50)->nullable();
            //unique quiere decir que sera unico
            $table->string('Nombre',100)->unique();
            //el valor 11 indica el numero de precision y el 2 son los decimales como maximo
            $table->decimal('Precio_Venta',11,2);
            $table->decimal('Precio_Compra',11,2);
            $table->string('N_Parte',50);
            $table->string('N_SAT',50);
            $table->integer('Stock');
            $table->string('Imagen',100);
            $table->string('Descripcion',256)->nullable();
            
            $table->string('C_Unidad',50)->nullable();
            $table->boolean('Condicion')->default(1);
            $table->timestamps();

            //Se crean la relaciones con otras tablas
            $table->foreign('ID_Categoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
