<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Aplicacion;


class AplicacionController extends Controller
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
        
        
        $aplicaciones = Aplicacion::select('Modelo','Ano','Motor')
        ->orderBy('id','desc')->get();
        
        return[
            'aplicaciones'=>$aplicaciones
        ];
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
        $aplicacion                     =   new Aplicacion();
        $aplicacion->ID_Articulo        =   $request->ID_Articulo;
        $aplicacion->Modelo             =   $request->Modelo;
        $aplicacion->Ano                =   $request->Ano;
        $aplicacion->Motor              =   $request->Motor;
        $aplicacion->save();
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
        $aplicacion = Aplicacion::findOrFail($request->ID);
        $aplicacion->Modelo     =   $request->Modelo;
        $aplicacion->Motor      =   $request->Motor;
        $aplicacion->Ano        =   $request->Ano;
        
        $aplicacion->save();
    }
    public function obtenerAplicaciones(Request $request){
        $Articulo = $request->ID_Articulo;
        $aplicaciones = Aplicacion::where('ID_Articulo','=',$Articulo)
        ->select('id','Modelo','Ano','Motor')
        ->orderBy('id','desc')->get();
        
        return[
            'aplicaciones'=>$aplicaciones
        ];
    }
    
}
