<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //
    protected $table = 'detalle_ventas';
    protected $fillable = [
        'ID_Venta',
        'ID_Articulo',
        'Cantidad',
        'Precio',
        'Descuento', 
    ];
    public $timestamps = false;
}
