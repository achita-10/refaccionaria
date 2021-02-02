<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_ingresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ID_Ingreso')->unsigned();
            $table->foreign('ID_Ingreso')->references('id')->on('Ingresos');
            $table->bigInteger('ID_Articulo')->unsigned();
            $table->foreign('ID_Articulo')->references('id')->on('Articulos');
            $table->integer('Cantidad');
            $table->decimal('Precio',11,2);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_ingresos');
    }
}
