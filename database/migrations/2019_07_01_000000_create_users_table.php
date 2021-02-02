<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->foreign('id')->references('id')->on('Personas')->onDelete('cascade');
            
            $table->string('usuario',50)->unique();
            $table->string('password');
            $table->boolean('Condicion')->default(1);

            $table->bigInteger('ID_Rol')->unsigned();
            $table->foreign('ID_Rol')->references('id')->on('Roles');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
