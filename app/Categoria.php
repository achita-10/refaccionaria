<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /*
    indica que la tabla a la que hara referencia el modelo es categorias
    protected $table = 'categorias';
    asume que el nombre de la culumna definida como llave primaria es id
    protected $primaryKey = 'id';
    */
    protected $fillable = ['Nombre','Descripcion','Condicion'];
    //checar la documentacion en la seccion eloque ORM/relationships/ONE to  Many
    //Indicamos que una categoria puede tener varios articulos
    public function articulos(){
        //Se hace referencia al modelo Articulo
        return $this->hasMany('App\Articulo');
    }
}
