<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['guest']], function () {
    //Sessio
    //Esta linea de codigo es remplazada 
    //Auth::routes();
    //Por esta otra linea de codigo
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login','Auth\LoginController@login')->name('login');
});
//middleware auth, hace referencia a los usuarios autenticados
Route::group(['middleware' => ['auth']], function () {
    /*Cualquier Usuario autenticado podra ver lo siguiente */
    Route::get('/dashboard','DashboardController');
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');
    Route::post('/logout','Auth\LoginController@logout')->name('logout');

    Route::group(['middleware' => ['Almacenero']], function () {
        //
        //Controlador Categoria
        Route::get('/categoria','CategoriaController@index');
        Route::get('/categoria/seleccionar_categoria','CategoriaController@seleccionarCategoria');
        Route::post('/categoria/registrar','CategoriaController@store');
        Route::put('/categoria/actualizar','CategoriaController@update');
        Route::put('/categoria/activar','CategoriaController@activar');
        Route::put('/categoria/desactivar','CategoriaController@desactivar');
        //Controlador articulo
        Route::get('/articulo','ArticuloController@index');
        Route::get('/articulo/buscarArticulo','ArticuloController@buscarArticulo');
        Route::get('/articulo/listarArticulos','ArticuloController@listarArticulos');
        Route::post('/articulo/registrar','ArticuloController@store');
        Route::post('/articulo/imagen','ArticuloController@actualizarImagen');
        Route::put('/articulo/actualizar','ArticuloController@update');
        Route::put('/articulo/activar','ArticuloController@activar');
        Route::put('/articulo/desactivar','ArticuloController@desactivar');
        //PDF
        Route::get('/articulo/listarPDF','ArticuloController@listarPDF')->name('articulos_pdf');
        //Controlador Proveedores
        Route::get('/proveedor','ProveedorController@index');
        Route::post('/proveedor/registrar','ProveedorController@store');
        Route::put('/proveedor/actualizar','ProveedorController@update');
        Route::get('/proveedor/seleccionarProveedor','ProveedorController@seleccionarProveedor');

        //Controlador Ingresos
        Route::get('/ingreso','IngresoController@index');
        Route::get('/ingreso/obtenerCabecera','IngresoController@obtenerCabecera');
        Route::get('/ingreso/obtenerDetalles','IngresoController@obtenerDetalles');
        Route::post('/ingreso/registrar','IngresoController@store');
        Route::put('/ingreso/desactivar','IngresoController@desactivar');
        //Controlador Aplicaciones
        Route::get('/aplicacion','AplicacionController@index');
        Route::get('/aplicacion/obtenerAplicaciones','AplicacionController@obtenerAplicaciones');
        Route::post('/aplicacion/registrar','AplicacionController@store');
        Route::put('/aplicacion/actualizar','AplicacionController@update');
    });
    Route::group(['middleware' => ['Vendedor']], function () {
        //Controlador Cliente
        Route::get('/cliente','ClienteController@index');
        Route::post('/cliente/registrar','ClienteController@store');
        Route::put('/cliente/actualizar','ClienteController@update');
        Route::get('/cliente/seleccionarCliente','ClienteController@seleccionarCliente');
        //Controlador Ventas
        Route::get('/venta','VentaController@index');
        Route::get('/venta/obtenerCabecera','VentaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles','VentaController@obtenerDetalles');
        Route::post('/venta/registrar','VentaController@store');
        Route::put('/venta/desactivar','VentaController@desactivar');
        //PDF
        Route::get('/venta/PDF/{ID}','VentaController@PDF')->name('venta_pdf');

        //Controlador Articulo
        Route::get('/articulo/buscarArticuloVenta','ArticuloController@buscarArticuloVenta');
        Route::get('/articulo/listarArticulosVenta','ArticuloController@listarArticulosVenta');
    });
    Route::group(['middleware' => ['Administrador']], function () {
        //Controlador Categoria
        Route::get('/categoria','CategoriaController@index');
        Route::get('/categoria/seleccionar_categoria','CategoriaController@seleccionarCategoria');
        Route::post('/categoria/registrar','CategoriaController@store');
        Route::put('/categoria/actualizar','CategoriaController@update');
        Route::put('/categoria/activar','CategoriaController@activar');
        Route::put('/categoria/desactivar','CategoriaController@desactivar');
        //Controlador articulo
        Route::get('/articulo','ArticuloController@index');
        Route::get('/articulo/buscarArticulo','ArticuloController@buscarArticulo');
        Route::get('/articulo/listarArticulos','ArticuloController@listarArticulos');
        Route::post('/articulo/registrar','ArticuloController@store');
        Route::post('/articulo/imagen','ArticuloController@actualizarImagen');
        Route::put('/articulo/actualizar','ArticuloController@update');
        Route::put('/articulo/activar','ArticuloController@activar');
        Route::put('/articulo/desactivar','ArticuloController@desactivar');
        //PDF
        Route::get('/articulo/listarPDF','ArticuloController@listarPDF')->name('articulos_pdf');
        //Controlador Proveedores
        Route::get('/proveedor','ProveedorController@index');
        Route::post('/proveedor/registrar','ProveedorController@store');
        Route::put('/proveedor/actualizar','ProveedorController@update');
        Route::get('/proveedor/seleccionarProveedor','ProveedorController@seleccionarProveedor');
        //Controlador Cliente
        Route::get('/cliente','ClienteController@index');
        Route::post('/cliente/registrar','ClienteController@store');
        Route::put('/cliente/actualizar','ClienteController@update');
        Route::get('/cliente/seleccionarCliente','ClienteController@seleccionarCliente');
        //Roles 
        Route::get('/rol','RolController@index');
        Route::get('/rol/seleccionar_rol','RolController@seleccionarRol');
        //Controlador Users
        Route::get('/users','UserController@index');
        Route::post('/users/registrar','UserController@store');
        Route::put('/users/actualizar','UserController@update');
        Route::put('/users/activar','UserController@activar');
        Route::put('/users/desactivar','UserController@desactivar');
        //Controlador Ingresos
        Route::get('/ingreso','IngresoController@index');
        Route::get('/ingreso/obtenerCabecera','IngresoController@obtenerCabecera');
        Route::get('/ingreso/obtenerDetalles','IngresoController@obtenerDetalles');
        Route::post('/ingreso/registrar','IngresoController@store');
        Route::put('/ingreso/desactivar','IngresoController@desactivar');
        //Controlador Aplicaciones
        Route::get('/aplicacion','AplicacionController@index');
        Route::get('/aplicacion/obtenerAplicaciones','AplicacionController@obtenerAplicaciones');
        Route::post('/aplicacion/registrar','AplicacionController@store');
        Route::put('/aplicacion/actualizar','AplicacionController@update');
        //Controlador Ventas
        Route::get('/venta','VentaController@index');
        Route::get('/venta/obtenerCabecera','VentaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles','VentaController@obtenerDetalles');
        Route::post('/venta/registrar','VentaController@store');
        Route::put('/venta/desactivar','VentaController@desactivar');
        //PDF
        Route::get('/venta/PDF/{ID}','VentaController@PDF')->name('venta_pdf');
    });
});


//Route::get('/home', 'HomeController@index')->name('home');
