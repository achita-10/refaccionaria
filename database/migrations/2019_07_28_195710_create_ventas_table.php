<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->bigInteger('ID_Cliente')->unsigned();
            // $table->foreign('ID_Cliente')->references('id')->on('personas');
            $table->bigInteger('ID_Usuario')->unsigned();
            $table->foreign('ID_Usuario')->references('id')->on('users');
            // $table->string('Tipo_Comprobante',20);
            /*Este campo puede ser nulo */
            // $table->string('Num_Folio',20)->nullable();
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
        Schema::dropIfExists('ventas');
    }
}
