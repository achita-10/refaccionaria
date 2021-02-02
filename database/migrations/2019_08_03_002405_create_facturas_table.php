<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ID_Venta')->unsigned();
            $table->foreign('ID_Venta')->references('id')->on('ventas');
            $table->bigInteger('ID_Cliente')->unsigned();
            $table->foreign('ID_Cliente')->references('id')->on('personas');
            $table->bigInteger('ID_Usuario')->unsigned();
            $table->foreign('ID_Usuario')->references('id')->on('users');
            $table->string('Uso',10);
            $table->string('Impuesto',10);
            $table->string('Tipo_Comprobante',10);
            $table->string('Num_Comprobante',50);
            $table->string('Moneda',10);
            $table->string('Forma_Pago',10);
            $table->string('Metodo_Pago',10);
            $table->string('Regimen',10);
            $table->dateTime('Fecha_Hora');
            


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
        Schema::dropIfExists('facturas');
    }
}
