<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre',50)->unique();
            $table->string('Descripcion',100)->nullable();
            $table->boolean('Condicion')->dafault(1);
            //$table->timestamps();
        });
        //Permite insertar roles
        DB::table('roles')->insert(array('id'=>'1','Nombre'=>'Administrador','Descripcion'=>'Administradores de Área','Condicion'=>'1'));
        DB::table('roles')->insert(array('id'=>'2','Nombre'=>'Vendedor','Descripcion'=>'Vendedor Área Venta','Condicion'=>'1'));
        DB::table('roles')->insert(array('id'=>'3','Nombre'=>'Almacenero','Descripcion'=>'Almacenero Área Compras','Condicion'=>'1'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
