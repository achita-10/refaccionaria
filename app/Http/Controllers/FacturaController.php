<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Factura;

class FacturaController extends Controller
{
    
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
            $factura = new Factura();
            $factura->ID_Venta          =   $request->ID_Venta;
            $factura->ID_Cliente        =   $request->ID_Cliente;
            //Al campo ID_Usuario se le envia el usuario que se ha autenticado
            $factura->ID_Usuario        =   \Auth::user()->id;
            $factura->Uso               =   $request->Uso;
            $factura->Impuesto          =   $request->Impuesto;
            $factura->Tipo_Comprobante  =   $request->Tipo_Comprobante;
            $factura->Num_Comprobante   =   $request->Num_Comprobante;
            $factura->Moneda            =   $request->Moneda;
            $factura->Forma_Pago        =   $request->Forma_Pago;
            $factura->Metodo_Pago       =   $request->Metodo_Pago;
            $factura->Regimen           =   $request->Regimen;
            /*Obtiene solo la fecha */
            //$factura->Fecha_Hora        =   $mytime->toDateString();
            /*Obtiene fecha y hora */
            $factura->Fecha_Hora        =   $mytime->toDateTimeString();  
            $factura->save();
            DB::commit();
            // return [
            //     'id' => $venta->id
            // ];
        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();
        }
        
        
    }
}
