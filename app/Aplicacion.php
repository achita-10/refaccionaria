<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplicacion extends Model
{
    protected $table = 'Aplicaciones';

    protected $fillable =[
        'ID_Articulo',
        'Modelo',
        'Ano',
        'Motor',
    ];
    public $timestamps =false;
    
}
