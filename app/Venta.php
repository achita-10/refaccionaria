<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $fillable = [
        // 'ID_Cliente',
        'ID_Usuario',
        // 'Tipo_Comprobante',
        // 'Num_Comprobante',
        'Fecha_Hora',
        'Impuesto',
        'Total',
        'Estado',
    ];
    
}
