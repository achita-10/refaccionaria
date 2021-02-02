<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Articulo;
use Yajra\Datatables\Datatables;
class ArticuloController extends Controller
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
        
        $articulos = Articulo::join('Categorias','articulos.ID_Categoria','=','Categorias.id')
        ->orderBy('Articulos.id','desc')
        ->select('Articulos.id','Articulos.ID_Categoria','Articulos.Codigo','Articulos.Nombre',
        'Categorias.Nombre as Nombre_Categoria','Articulos.Precio_Venta','Articulos.Stock',
        'Articulos.Descripcion','Articulos.Condicion','Articulos.Precio_Compra',
        'Articulos.N_Parte','Articulos.N_SAT','Articulos.Imagen','Articulos.C_Unidad')
        ->get();
        $cont = ((int) Articulo::count())+1;
        return[
            'Numero_Articulo' => $cont,
            'articulos'=>$articulos
        ];
    } 
    public function listarPDF() {
        
        $articulos = Articulo::join('Categorias','articulos.ID_Categoria','=','Categorias.id')
        ->select('Articulos.id','Articulos.ID_Categoria','Articulos.Codigo','Articulos.Nombre',
        'Categorias.Nombre as Nombre_Categoria','Articulos.Precio_Venta','Articulos.Stock',
        'Articulos.Descripcion','Articulos.Condicion','Articulos.Precio_Compra',
        'Articulos.N_Parte','Articulos.N_SAT')
        ->orderBy('Articulos.Nombre','desc')->get();
        $cont = Articulo::count(); 
        
        $pdf = \PDF::loadView('pdf.articulospdf',['articulos'=>$articulos,'cont'=>$cont]);
        //Metodo para visualizar desde el navegador sin descargar el archivo
        return $pdf->stream();
        //Metodo para descargar el archivo despues de generado
        //return $pdf->download('articulos.pdf');
    }
    /*Funcion utilizada por VentaController */
    public function listarArticulosVenta(Request $request)
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

        
        $articulos = Articulo::join('Categorias','articulos.ID_Categoria','=','Categorias.id')
        ->select('Articulos.id','Articulos.ID_Categoria','Articulos.Codigo','Articulos.Nombre',
        'Categorias.Nombre as Nombre_Categoria','Articulos.Precio_Venta','Articulos.Stock',
        'Articulos.Descripcion','Articulos.Condicion','Articulos.Precio_Compra','Articulos.N_Parte',
        'Articulos.N_SAT','Articulos.Imagen')
        ->where('Articulos.Stock','>','0')
        ->orderBy('Articulos.id','desc')->get();
        
        return[ 'articulos' => $articulos ];
    } 
    /*Funcion utilizada por VentaController */
    public function buscarArticuloVenta(Request $request){
        if(!$request->ajax()) return redirect('/');
        $Filtro = $request->Filtro;

        //La funcion take devuel un solo registro
        $articulos = Articulo::where('Codigo','=',$Filtro)
        ->select('id','Nombre','Stock','Precio_Venta')
        ->where('Stock','>','0')
        ->orderBy('Nombre','asc')
        ->take(1)->get();

        return ['articulos'=>$articulos];
    }
    /*listarArticulos y buscarArticulo se utilizan en IngresoComponent */
    public function listarArticulos(Request $request)
    {
        //Se define una condicion que la peticion sea de tipo ajax para acceder al contenido, 
        // de lo contrario redirecciona a la seccion precipal del sistema (revisar regla de ruteo)
        if(!$request->ajax()) return redirect('/');
        
        $articulos = Articulo::join('Categorias','articulos.ID_Categoria','=','Categorias.id')
        ->orderBy('Articulos.id','desc')
        ->select('Articulos.id','Articulos.ID_Categoria','Articulos.Codigo','Articulos.Nombre',
        'Categorias.Nombre as Nombre_Categoria','Articulos.Precio_Venta','Articulos.Stock',
        'Articulos.Descripcion','Articulos.Condicion','Articulos.Precio_Compra',
        'Articulos.N_Parte','Articulos.N_SAT','Articulos.Imagen')
        ->get();
        
        return[ 'articulos' => $articulos ];
    } 
    public function buscarArticulo(Request $request){
        if(!$request->ajax()) return redirect('/');
        $Filtro = $request->Filtro;

        //La funcion take devuel un solo registro
        $articulos = Articulo::where('Codigo','=',$Filtro)
        ->select('id','Nombre')->orderBy('Nombre','asc')->take(1)->get();

        return ['articulos'=>$articulos];
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
        
        $articulo                   =   new Articulo();

       $ruta = '';
 
        // Verificamos si hay un file con nombre File
        if ($request->hasFile('File')) {
            $img = $request->file('File');
            $ruta = time().'_'.$img->getClientOriginalName();
            Storage::disk('img')->put($ruta,file_get_contents($img->getRealPath()));   
            
        }
        $articulo->id               =   $request->Numero;
        $articulo->ID_Categoria     =   $request->ID_Categoria;
        $articulo->Codigo           =   $request->Codigo;
        $articulo->Nombre           =   $request->Nombre;
        $articulo->Precio_Venta     =   $request->Precio_Venta;
        $articulo->Precio_Compra    =   $request->Precio_Compra;
        $articulo->N_Parte          =   $request->N_Parte;
        $articulo->N_SAT            =   $request->N_SAT;
        $articulo->Stock            =   $request->Stock;
        $articulo->Descripcion      =   $request->Descripcion;
        
        $articulo->C_Unidad         =   $request->C_Unidad;
        $articulo->Imagen           =   $ruta;
        $articulo->Condicion        =   '1';
        $articulo->save();

        
        
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
        
        $articulo = Articulo::findOrFail($request->ID);
        
        $articulo->ID_Categoria     =   $request->ID_Categoria;
        $articulo->Codigo           =   $request->Codigo;
        $articulo->Nombre           =   $request->Nombre;
        $articulo->Precio_Venta     =   $request->Precio_Venta;
        $articulo->Precio_Compra    =   $request->Precio_Compra;
        $articulo->N_Parte          =   $request->N_Parte;
        $articulo->N_SAT            =   $request->N_SAT;
        $articulo->Stock            =   $request->Stock;
        $articulo->Descripcion      =   $request->Descripcion;
        
        $articulo->C_Unidad         =   $request->C_Unidad;
        //$articulo->Imagen           =   $ruta;
        $articulo->Condicion        =   '1';
        $articulo->save();
    }
    public function actualizarImagen(Request $request){
        if(!$request->ajax()) return redirect('/');
        
        $articulo = Articulo::findOrFail($request->ID);
        $ruta = '';
 
        // Verificamos si hay un file con nombre File
        if ($request->hasFile('File')) {
            $img = $request->file('File');
            $ruta = time().'_'.$img->getClientOriginalName();
            Storage::disk('img')->put($ruta,file_get_contents($img->getRealPath()));   
            
        }
        $articulo->Imagen           =   $ruta;
        $articulo->save();
    }
    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $articulo = Articulo::findOrFail($request->ID);
        $articulo->Condicion   =   '0';
        $articulo->save();
    }
    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $articulo = Articulo::findOrFail($request->ID);
        $articulo->Condicion   =   '1';
        $articulo->save();
    }
}
