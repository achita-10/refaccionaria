<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Ingreso;
use App\DetalleIngreso;

class IngresoController extends Controller
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
        
        $ingresos = Ingreso::join('Personas','Ingresos.ID_Proveedor','=','Personas.id')
        ->join('users','Ingresos.ID_Usuario','=','users.id')
        ->select('Ingresos.id','Ingresos.Tipo_Comprobante',
        'Ingresos.Num_Folio','Ingresos.Fecha_Hora','Ingresos.Impuesto',
        'Ingresos.Total','Ingresos.Estado','Personas.Nombre','users.usuario')
        ->orderBy('Ingresos.id','desc')->get();
        
        return[
            'ingresos'=>$ingresos
        ];
        
        //return $proveedores;
    } 
    public function obtenerCabecera(Request $request){
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
        $ID = $request->ID;

        $ingreso = Ingreso::join('Personas','Ingresos.ID_Proveedor','=','Personas.id')
        ->join('users','Ingresos.ID_Usuario','=','users.id')
        ->select('Ingresos.id','Ingresos.Tipo_Comprobante',
        'Ingresos.Num_Folio','Ingresos.Fecha_Hora','Ingresos.Impuesto',
        'Ingresos.Total','Ingresos.Estado','Personas.Nombre','users.usuario')
        ->where('Ingresos.id','=',$ID)
        ->orderBy('Ingresos.id','desc')->take(1)->get();
        
        return[ 'ingreso'=>$ingreso];
        
    }
    public function obtenerDetalles(Request $request){
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
        $ID = $request->ID;

        $detalles = DetalleIngreso::join('Articulos','Detalles_Ingresos.ID_Articulo','=','Articulos.id')
        
        ->select('Detalles_Ingresos.Cantidad','Detalles_Ingresos.Precio','Articulos.Nombre as Articulo')
        ->where('Detalles_Ingresos.ID_Ingreso','=',$ID)
        ->orderBy('Detalles_Ingresos.id','desc')->get();
        
        return[ 'detalles'=>$detalles];
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
            //Variable para el campo fecha
            $mytime = Carbon::now('America/Mexico_City');

            //Se utilizaran transacciones
            DB::beginTransaction();
            $ingreso = new Ingreso();
            $ingreso->ID_Proveedor      =   $request->ID_Proveedor;
            //Al campo ID_Usuario se le envia el usuario que se ha autenticado

            $ingreso->ID_Usuario        =   \Auth::user()->id;

            $ingreso->Tipo_Comprobante  =   $request->Tipo_Comprobante;
            $ingreso->Num_Folio         =   $request->Num_Folio;
            $ingreso->Fecha_Hora        =   $mytime->toDateTimeString();
            $ingreso->Impuesto          =   $request->Impuesto;
            $ingreso->Total             =   $request->Total;
            $ingreso->Estado            =   'Registrado';
            $ingreso->save();

            $detalles = $request->data;

            foreach ($detalles as $key => $det) {
                $detalle = new DetalleIngreso();
                $detalle->ID_Ingreso    =   $ingreso->id;
                $detalle->ID_Articulo   =   $det['ID_Articulo'];
                $detalle->Cantidad      =   $det['Cantidad'];
                $detalle->Precio        =   $det['Precio'];
                $detalle->save();
            }



            DB::commit();
        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();
        }
        
        
    }
    //No se implemento la funcion update, ya que no se podran modificar los  ingresos
    //por el contrario se tendran que utilizar trigers que nos permitiran actualizar el stock
    //para ello primero se tienen que anular los ingresos y si se desea volverlo a registrar
    public function desactivar(Request $request)
    {
        //Se implementara un triger para actualizar el stock cuando se registre un ingreso 
        //y otro triger cuando se anule un stock del ingreso almacen
        if(!$request->ajax()) return redirect('/');
        $ingreso = Ingreso::findOrFail($request->ID);
        $ingreso->Estado   =   'Anulado';
        $ingreso->save();
    }
}
