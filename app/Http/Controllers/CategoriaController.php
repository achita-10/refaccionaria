<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Se define una condicion que la peticion sea de tipo ajax para acceder al contenido, 
        // de lo contrario redirecciona a la seccion precipal del sistema (revisar regla de ruteo)
        if(!$request->ajax()) return redirect('/');
        //LA FUNCION ALL te devuel todos los registros de la tabla seleccionada en el modelo definido.
        //$categorias = Categoria::all();
        //Esta forma se utiliza para la paginacion de registros en la tabla de la vista utilizando query builder
        //$categorias = DB::table('Categorias')->paginate(2);
        //Paginacion utilizando eloque. cuando se trabaja con eloque ya no es necesario importa la clase db
        // use Illuminate\Support\Facades\DB;

        //$categorias = Categoria::paginate(2);
        
        $categorias = Categoria::orderBy('id','desc')->get();
        $cont = ((int) Categoria::count())+1;
        return[
            'Numero_Categoria' => $cont,
            'categorias'=>$categorias
        ];
        
        //return $categorias;
    } 
    /*esta funcion es utilizada por ArticuloComponent */
    public function seleccionarCategoria(Request $request){
        if(!$request->ajax()) return redirect('/');
        $categorias = Categoria:: where('Condicion','=','1')
        ->select('id','Nombre')
        ->orderBy('Nombre','asc')
        ->get();
        return ['categorias'=>$categorias];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $categoria = new Categoria();

        $categoria->Nombre      =   $request->Nombre;
        $categoria->Descripcion =   $request->Descripcion;
        $categoria->Condicion   =   '1';
        $categoria->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->ID);

        $categoria->Nombre      =   $request->Nombre;
        $categoria->Descripcion =   $request->Descripcion;
        $categoria->Condicion   =   '1';
        $categoria->save();
    }
    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->ID);
        $categoria->Condicion   =   '0';
        $categoria->save();
    }
    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->ID);
        $categoria->Condicion   =   '1';
        $categoria->save();
    }
}
