<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*Permite trabajar con transacciones */
use Illuminate\Support\Facades\DB;
/*Permite trabajar con fechas */
use Carbon\Carbon;
use App\Venta;
use App\DetalleVenta;
use App\Factura;
class VentaController extends Controller
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

        $ventas = Venta::join('users','Ventas.ID_Usuario','=','users.id')
        ->select('Ventas.id','Ventas.Fecha_Hora','Ventas.Impuesto',
        'Ventas.Total','Ventas.Estado','users.usuario')
        ->orderBy('Ventas.id','desc')->get();
        
        return[
            
            'ventas'=>$ventas
        ];
        
        //return $proveedores;
    } 
    public function PDF (Request $request,$ID){
        $venta = Venta::select('id','created_at','Impuesto',
        'Total','Estado')
        ->where('id','=',$ID)
        ->orderBy('id','desc')->take(1)->get();

        $detalles = DetalleVenta::join('Articulos','Detalle_Ventas.ID_Articulo','=','Articulos.id')
        
        ->select('Detalle_Ventas.Cantidad','Detalle_Ventas.Precio','Detalle_Ventas.Descuento',
        'Articulos.Nombre as Articulo','Articulos.N_SAT','Articulos.N_Parte','Articulos.N_Parte')
        ->where('Detalle_Ventas.ID_Venta','=',$ID)
        ->orderBy('Detalle_Ventas.id','desc')->get();

        $factura = Factura::join('Personas','Personas.id','=','Facturas.ID_Cliente')
        ->join('users','Facturas.ID_Usuario','=','users.id')
        ->select('Personas.Nombre as Cliente','Personas.Tipo_Documento as Doc_Cliente',
        'Personas.Num_documento as RFC_Cliente','Personas.Direccion', 'Personas.Telefono',
        'Personas.Email','Facturas.Num_Comprobante as Folio','Facturas.Uso','Facturas.Tipo_Comprobante',
        'Facturas.Moneda','Facturas.Forma_Pago','Facturas.Metodo_Pago','Facturas.Regimen','Facturas.Fecha_Hora')
        ->where('Facturas.ID_Venta','=',$ID)
        ->orderBy('Facturas.id','desc')->get();
        //obtener un numero de venta
        $num_venta = Factura::select('Num_Comprobante')->where('ID_Venta',$ID)->get();
        

        $pdf = \PDF::loadView('pdf.venta',['venta'=>$venta,'detalles'=>$detalles,'factura'=>$factura]);
        //Metodo para visualizar desde el navegador sin descargar el archivo
        return $pdf->stream('venta-.pdf');
        //Metodo para descargar el archivo despues de generado
        //return $pdf->download('articulos.pdf');
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

        $venta = Venta::join('users','Ventas.ID_Usuario','=','users.id')
        ->select('Ventas.id','Ventas.Fecha_Hora','Ventas.Impuesto',
        'Ventas.Total','Ventas.Estado','users.usuario')
        ->where('Ventas.id','=',$ID)
        ->orderBy('Ventas.id','desc')->take(1)->get();
        
        return[ 'venta'=>$venta];
        
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

        $detalles = DetalleVenta::join('Articulos','Detalle_Ventas.ID_Articulo','=','Articulos.id')
        
        ->select('Detalle_Ventas.Cantidad','Detalle_Ventas.Precio','Detalle_Ventas.Descuento',
        'Articulos.Nombre as Articulo')
        ->where('Detalle_Ventas.ID_Venta','=',$ID)
        ->orderBy('Detalle_Ventas.id','desc')->get();
        
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
            $venta = new Venta();
            // $venta->ID_Cliente      =   $request->ID_Cliente;
            //Al campo ID_Usuario se le envia el usuario que se ha autenticado

            $venta->ID_Usuario        =   \Auth::user()->id;

            // $venta->Tipo_Comprobante  =   $request->Tipo_Comprobante;
            
            // $venta->Num_Folio         =   $request->Num_Comprobante;
            /*Obtiene solo la fecha */
            //$venta->Fecha_Hora        =   $mytime->toDateString();
            /*Obtiene fecha y hora */
            $venta->Fecha_Hora        =   $mytime->toDateTimeString();  
            $venta->Impuesto          =   $request->Impuesto;
            $venta->Total             =   $request->Total;
            $venta->Estado            =   'Registrado';
            $venta->save();

            $detalles = $request->data;

            foreach ($detalles as $key => $det) {
                $detalle = new DetalleVenta();
                $detalle->ID_Venta      =   $venta->id;
                $detalle->ID_Articulo   =   $det['ID_Articulo'];
                $detalle->Cantidad      =   $det['Cantidad'];
                $detalle->Precio        =   $det['Precio'];
                $detalle->Descuento     =   $det['Descuento'];
                $detalle->save();
            }
            DB::commit();
            return [
                'id' => $venta->id
            ];
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
        $venta = Venta::findOrFail($request->ID);
        $venta->Estado   =   'Anulado';
        $venta->save();
    }
}
