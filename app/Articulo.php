<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillabe = [
        'ID_Categoria',
        'Codigo',
        'Nombre',
        'Precio_Venta',
        'Stock',
        'Descripcion',
        'Imagen',
        'Condicion',
        
        'C_Unidad'
    ];    
    //checar la documentacion en la seccion eloque ORM/relationships/ONE to  ONE
    //un articulo pertenece a una categoria
    public function categoria(){
        //Hace referencia al Modelo Categoria
        return $this->belongsTo('App\Categoria');
    }
}
