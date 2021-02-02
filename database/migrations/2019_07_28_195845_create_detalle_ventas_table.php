<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            /*LLave foranea de la tabla venta */
            $table->bigInteger('ID_Venta')->unsigned();
            /* Se indica que la eliminacion va hacer en cascada */
            $table->foreign('ID_Venta')->references('id')->on('ventas')->onDelete('cascade');
            /*LLave foranea de la tabla articulo */
            $table->bigInteger('ID_Articulo')->unsigned();
            $table->foreign('ID_Articulo')->references('id')->on('articulos');
            $table->integer('Cantidad');
            $table->decimal('Precio',11,2);
            $table->decimal('Descuento',11,2);
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
        Schema::dropIfExists('detalle_ventas');
    }
}
