<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ID_Proveedor')->unsigned();
            $table->foreign('ID_Proveedor')->references('id')->on('Proveedores');
            $table->bigInteger('ID_Usuario')->unsigned();
            $table->foreign('ID_Usuario')->references('id')->on('users');
            $table->string('Tipo_Comprobante',20);
            $table->string('Num_Folio',20);
            $table->dateTime('Fecha_Hora');
            $table->decimal('Impuesto',4,2);
            $table->decimal('Total',11,2);
            $table->string('Estado',20);
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
        Schema::dropIfExists('ingresos');
    }
}
