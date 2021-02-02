<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    //No se declara la variable table, por que laravel asume que la tabla a la que hace referencia
    //es el plurar del nombre del modelo
    protected $fillable= [
        'ID_Proveedor',
        'ID_Usuario',
        'Tipo_Comprobante',
        'Num_Folio',
        'Fecha_Hora',
        'Impuesto',
        'Total',
        'Estado',
    ];

    //Permite obtener el usuario que registra al ingreso
    public function usuario(){
        return $this->belongsTo('App\User');
    }
    //obtener el proveedor que entrega el producto
    public function proveedor(){
        return $this->belongsTo('App\Proveedor');
    }
}
