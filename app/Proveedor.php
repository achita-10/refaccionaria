<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //se debe especificar el nombre de la tabla a la que hace referencia
    protected $table = 'proveedores';
    //Se especifican los campos a los cuales se les ingresara informacion
    protected $fillable = ['id','Contacto','Telefono_Contacto'];
    //en esta caso como no se especificaron los campos timestamps, se deben especificar como null
    public $timestamps = false;

    public function persona(){
        //Se retorna el modelo Persona
        return $this->belongsTo('App\Persona');
    }
}
