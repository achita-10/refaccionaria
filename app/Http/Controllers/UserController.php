<?php

namespace App\Http\Controllers;

use App\User;
use App\Persona;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $usuarios = User::join('Personas','users.id','=','Personas.id')
        ->join('roles','users.ID_Rol','=','roles.id')
        ->select('Personas.id','Personas.Nombre','Personas.Tipo_Documento',
        'Personas.Num_Documento','Personas.Direccion','Personas.Telefono',
        'Personas.Email','users.usuario','users.password','users.Condicion',
        'users.ID_Rol','roles.Nombre as Rol')
        ->orderBy('Personas.id','desc')->get();
        return[
            'usuarios'=>$usuarios
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

            $user = new User();
            $user->usuario          =   $request->Usuario;
            $user->password         =   bcrypt($request->Password);
            $user->Condicion        =   '1';
            $user->ID_Rol           =   $request->ID_Rol;
            $user->id               =   $persona->id;
            $user->save();
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
            DB::beginTransaction();
            //Buscar primero el proveedor a modificar
            $user = User::findORFail($request->ID);
            //Buscar a ña persona que conincida con el id del proveedor
            $persona = Persona::findOrFail($user->id);
            $persona->Nombre            =   $request->Nombre;
            $persona->Tipo_Documento    =   $request->Tipo_Documento;
            $persona->Num_Documento     =   $request->Num_Documento;
            $persona->Direccion         =   $request->Direccion;
            $persona->Telefono          =   $request->Telefono;
            $persona->Email             =   $request->Email;
            $persona->save();
            $user->usuario          =   $request->Usuario;
            $user->password         =   bcrypt($request->Password);
            $user->Condicion        =   '1';
            $user->ID_Rol           =   $request->ID_Rol;
            //El campo id ya no se modifica
            //$proveedor->id                  =   $persona->id;
            $user->save();
            DB::commit();
        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();
        }
    }
    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->ID);
        $user->Condicion   =   '0';
        $user->save();
    }
    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->ID);
        $user->Condicion   =   '1';
        $user->save();
    }
}
