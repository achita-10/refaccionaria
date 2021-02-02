<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function __invoke(Request $request)
    {
        /*La ventaja de __invoke es que cuando se registre una ruta hacia nuestro controlador
            no se necesita especificar ningun metodo en la ruta. laravel asume que por defecto
            se utiliza la funcion __invoke
        */
        $anio = date('Y');
        /*El método whereYear hace una codicion donde el año sea igual al de la variable anio
            que obtiene el año actual    
        */
        $ingresos = DB::table('ingresos as i')
        ->select(DB::raw('MONTH(i.Fecha_Hora) as mes'),
        DB::raw('YEAR(i.Fecha_Hora) as anio'),
        DB::raw('SUM(i.Total) as total'))
        ->whereYear('i.Fecha_Hora',$anio)
        ->groupBy(DB::raw('MONTH(i.Fecha_Hora)'),DB::raw('Year(i.Fecha_Hora)'))
        ->get();

        $ventas = DB::table('ventas as v')
        ->select(DB::raw('MONTH(v.Fecha_Hora) as mes'),
        DB::raw('YEAR(v.Fecha_Hora) as anio'),
        DB::raw('SUM(v.Total) as total'))
        ->whereYear('v.Fecha_Hora',$anio)
        ->groupBy(DB::raw('MONTH(v.Fecha_Hora)'),DB::raw('Year(v.Fecha_Hora)'))
        ->get();

        return ['ventas'=>$ventas,'anio'=>$anio,'ingresos'=>$ingresos];   
    }
}
