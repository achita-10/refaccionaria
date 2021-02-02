<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //Se definen a todas las columnas que van a recibir valores en la tabla personas
    protected $fillable = ['Nombre','Tipo_Documento','Num_Documento','Direccion','Telefono','Email'];

    public function provedor(){
        //se indica que una persona solo puede estar asociada a un proovedor
        return $this->hasOne('App\Proveedor');
    }
    public function user(){
        return $this->hasOne('App\User');
    }
}
