<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class ClienteController extends Controller
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
        
        $clientes = Persona::orderBy('id','desc')->get();
        
        return[
            'clientes'=>$clientes
        ];
        
        //return $clientes;
    } 
    /*Funcion utilizada por VentaController */
    public function seleccionarCliente(Request $request){
        if(!$request->ajax()) return redirect('/');
        $Filtro =   $request->Filtro;
        $clientes    =   Persona::where('Nombre','like','%'.$Filtro.'%')
        ->orWhere('Num_Documento','like','%'.$Filtro.'%')
        ->select('id','Nombre','Num_Documento')
        ->orderBy('Nombre','asc')->get();
        return ['clientes'=>$clientes];
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
        $persona = new Persona();

        $persona->Nombre            =   $request->Nombre;
        $persona->Tipo_Documento    =   $request->Tipo_Documento;
        $persona->Num_Documento     =   $request->Num_Documento;
        $persona->Direccion         =   $request->Direccion;
        $persona->Telefono          =   $request->Telefono;
        $persona->Email             =   $request->Email;
        
        $persona->save();
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
        $persona = Persona::findOrFail($request->ID);
        $persona->Nombre            =   $request->Nombre;
        $persona->Tipo_Documento    =   $request->Tipo_Documento;
        $persona->Num_Documento     =   $request->Num_Documento;
        $persona->Direccion         =   $request->Direccion;
        $persona->Telefono          =   $request->Telefono;
        $persona->Email             =   $request->Email;
        $persona->save();
    }
}
