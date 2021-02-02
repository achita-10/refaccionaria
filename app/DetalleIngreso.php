<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table = 'Detalles_Ingresos';

    protected $fillable =[
        'ID_Ingreso',
        'ID_Articulo',
        'Cantidad',
        'Precio',
    ];
    public $timestamps =false;
}
