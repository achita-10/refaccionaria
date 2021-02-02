<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Para utilizar transacciones sedebe importar la libreria correspondiente
use Illuminate\Support\Facades\DB;
use App\Proveedor;
use App\Persona;
class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $proveedores = Proveedor::join('Personas','Proveedores.id','=','Personas.id')
        ->select('Personas.id','Personas.Nombre','Personas.Tipo_Documento',
        'Personas.Num_Documento','Personas.Direccion','Personas.Telefono',
        'Personas.Email','Proveedores.Contacto','Proveedores.Telefono_Contacto')
        ->orderBy('Personas.id','desc')->get();
        
        return[
            'proveedores'=>$proveedores
        ];
        
        //return $proveedores;
    } 
    /*Funcion utilizada por IngresoController */
    public function seleccionarProveedor(Request $request){
        if(!$request->ajax()) return redirect('/');
        $Filtro =   $request->Filtro;
        $proveedores    =   Proveedor::join('Personas','Proveedores.id','=','Personas.id')
        ->where('Personas.Nombre','like','%'.$Filtro.'%')
        ->orWhere('Personas.Num_Documento','like','%'.$Filtro.'%')
        ->select('Personas.id','Personas.Nombre','Personas.Num_Documento')
        ->orderBy('Personas.Nombre','asc')->get();
        return ['proveedores'=>$proveedores];
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
        //SE implementa un capturador de excepciones
        try {
            //Se utilizaran transacciones
            DB::beginTransaction();
            $persona = new Persona();
            $persona->Nombre            =   $request->Nombre;
            $persona->Tipo_Documento    =   $request->Tipo_Documento;
            $persona->Num_Documento     =   $request->Num_Documento;
            $persona->Direccion         =   $request->Direccion;
            $persona->Telefono          =   $request->Telefono;
            $persona->Email             =   $request->Email;
            $persona->save();

            $proveedor = new Proveedor();
            $proveedor->Contacto            =   $request->Contacto;
            $proveedor->Telefono_Contacto   =   $request->Telefono_Contacto;
            $proveedor->id                  =   $persona->id;
            $proveedor->save();
            DB::commit();
        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();
        }
        
        
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
        //SE implementa un capturador de excepciones
        try {
            //Se utilizaran transacciones
            //Buscar primero el proveedor a modificar
            

            //Buscar a ña persona que conincida con el id del proveedor

            DB::beginTransaction();


            $proveedor = Proveedor::findOrFail($request->ID);

            $persona = Persona::findOrFail($proveedor->id);
            $persona->Nombre            =   $request->Nombre;
            $persona->Tipo_Documento    =   $request->Tipo_Documento;
            $persona->Num_Documento     =   $request->Num_Documento;
            $persona->Direccion         =   $request->Direccion;
            $persona->Telefono          =   $request->Telefono;
            $persona->Email             =   $request->Email;
            $persona->save();
            
            
            
            $proveedor->Contacto            =   $request->Contacto;
            $proveedor->Telefono_Contacto   =   $request->Telefono_Contacto;
            //El campo id ya no se modifica
            //$proveedor->id                  =   $persona->id;
            $proveedor->save();
            
            DB::commit();
        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();
        }
    }
}
