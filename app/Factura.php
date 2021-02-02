<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //
    protected $fillable = [
        'ID_Venta',
        'ID_Cliente',
        'ID_Usuario',
        'Uso',
        'Impuesto',
        'Tipo_Comprobante',
        'Num_Comprobante',
        'Moneda',
        'Forma_Pago',
        'Metodo_Pago',
        'Regimen',
        'Fecha_Hora',

    ];
    public $timestamps = false;
}
