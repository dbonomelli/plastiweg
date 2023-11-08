<?php

use Illuminate\Support\Facades\Route;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Csv as CsvReader;
use PhpOffice\PhpSpreadsheet\Writer\Ods;
use PhpOffice\PhpSpreadsheet\Reader\Ods as OdsReader;
use PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Style\Border;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
| en archivo .env se de cambiar APP_DEBUG=true a APP_DEBUG=false cuando se termine la pagina
*/

// Route::get('/', function () {
//     return view('home.index');
// }) -> name('inicio');

//Invitados
Route::get('/', 'App\Http\Controllers\HomeController@indexGuest') -> name('home');
Route::get('/catalogo', 'App\Http\Controllers\ProductoController@indexGuest') -> name('catalogo');
Route::post('/catalogo', 'App\Http\Controllers\ProductoController@buscarGuest') ->name('catalogo.buscar');

//Pagina Inicio
Route::get('/inicio', 'App\Http\Controllers\HomeController@index') -> name('inicio');

//Productos
Route::get('/inventario', 'App\Http\Controllers\ProductoController@inventario') -> name('productos.inventario');
Route::get('/inventario/create', 'App\Http\Controllers\ProductoController@create') -> name('productos.create');
Route::post('/inventario/store', 'App\Http\Controllers\ProductoController@store') -> name('productos.store');
Route::get('/productos/{producto}', 'App\Http\Controllers\ProductoController@show') -> name('productos.show');
Route::get('/inventario/{producto}/edit', 'App\Http\Controllers\ProductoController@edit') -> name('productos.edit');
Route::put('/inventario/{producto}', 'App\Http\Controllers\ProductoController@update')->name('productos.update');
Route::delete('/inventario/{producto}/delete', 'App\Http\Controllers\ProductoController@destroy') -> name('productos.destroy');
Route::post('/inventario/{producto}/restore', 'App\Http\Controllers\ProductoController@restore') -> name('productos.restore');
Route::post('/inventario', 'App\Http\Controllers\ProductoController@buscarInv') ->name('inventario.buscar');

//Ajustes de Stock
Route::get('/ajuste-stock', 'App\Http\Controllers\AjusteStockController@index') ->name('ajuste');
Route::get('ajuste-stock/create', 'App\Http\Controllers\AjusteStockController@create') ->name('ajuste.create');
Route::post('ajuste-stock/store', 'App\Http\Controllers\AjusteStockController@store') ->name('ajuste.store');
Route::get('ajuste-stock/{ajusteStock}/edit', 'App\Http\Controllers\AjusteStockController@edit') ->name('ajuste.edit');
Route::put('ajuste-stock/{ajusteStock}', 'App\Http\Controllers\AjusteStockController@update') ->name('ajuste.update');

//Cotizacion
Route::get('/cotizaciones', 'App\Http\Controllers\CotizacionController@index') -> name('cotizaciones');
Route::get('/cotizaciones/create', 'App\Http\Controllers\CotizacionController@create') -> name('cotizaciones.create');
Route::get('/cotizaciones/SeleccionCliente', 'App\Http\Controllers\CotizacionController@seleccionclientes') -> name('cotizaciones.clientes');
Route::post('/cotizaciones/store', 'App\Http\Controllers\CotizacionController@store') -> name('cotizaciones.store');
Route::post('/cotizaciones/ConsultarCotizacion', 'App\Http\Controllers\CotizacionController@buscar') ->name('cotizaciones.buscar');
Route::post('/cotizaciones/ConsultarSeguimientoCotizacion', 'App\Http\Controllers\CotizacionController@buscarSeguimientoCotizacion') ->name('cotizaciones.buscarSeguimientoCotizacion');

//otros cotizacion
Route::post('/cotizaciones/TotalProductos', 'App\Http\Controllers\CotizacionController@totalproductos') -> name('cotizaciones.total');
Route::get('/cotizaciones/SeguirCotizacion', 'App\Http\Controllers\CotizacionController@seguircotizacion') -> name('cotizaciones.seguir');
Route::get('/cotizaciones/ConsultarCotizacion', 'App\Http\Controllers\CotizacionController@consultarcotizacion') -> name('cotizaciones.consulta');
Route::post('/cotizaciones/descarga', 'App\Http\Controllers\CotizacionController@descarga') ->name('cotizaciones.descarga');
Route::post('/cotizaciones/volver', 'App\Http\Controllers\CotizacionController@volver') ->name('cotizaciones.volver');

//detalle cotizacion
Route::get('/detalles_cotizaciones/index', 'App\Http\Controllers\DetalleController@index') -> name('detalles.index');
Route::get('/detalles_cotizaciones/create', 'App\Http\Controllers\DetalleController@create') -> name('detalles.create');
Route::post('/detalles_cotizaciones/store', 'App\Http\Controllers\DetalleController@store') -> name('detalles.store');
Route::post('/detalles_cotizaciones/cancelar', 'App\Http\Controllers\DetalleController@cancelar') ->name('detalles.cancelar');
Route::post('/detalles_cotizaciones/borrar', 'App\Http\Controllers\DetalleController@borrar') ->name('detalles.borrar');

//log in/out
Route::get('/login', 'App\Http\Controllers\VendedorController@home')->name('vendedor.index');
Route::post('/vendedores/login', 'App\Http\Controllers\VendedorController@login')->name('vendedor.login');
Route::get('/vendedores/logout', 'App\Http\Controllers\VendedorController@logout')->name('vendedor.logout');

//Vendedores
Route::get('/vendedores', 'App\Http\Controllers\VendedorCrearController@index') ->name('vendedor');
Route::get('/vendedores/create', 'App\Http\Controllers\VendedorCrearController@create')->name('vendedor.create');
Route::post('/vendedores/store', 'App\Http\Controllers\VendedorCrearController@store') ->name('vendedor.store');
Route::get('/vendedores', 'App\Http\Controllers\VendedorCrearController@lista')->name('vendedor.lista');
Route::get('/vendedores/{vendedor}/edit', 'App\Http\Controllers\VendedorCrearController@edit') -> name('vendedor.edit');
Route::delete('/vendedores/{vendedor}/delete', 'App\Http\Controllers\VendedorCrearController@destroy') -> name('vendedor.destroy');
Route::put('vendedores/{vendedor}',  'App\Http\Controllers\VendedorCrearController@update') ->name('vendedor.update');
Route::get('/vendedores/{vendedor}', 'App\Http\Controllers\VendedorCrearController@show') ->name('vendedor.show');

//CLIENTES
Route::get('/clientes', 'App\Http\Controllers\ClienteController@index') ->name('cliente');
Route::get('/clientes/create', 'App\Http\Controllers\ClienteController@create') ->name('cliente.create');
Route::get('/clientes/createCliente', 'App\Http\Controllers\ClienteController@createCliente') ->name('cliente.createCliente');
Route::get('/clientes/creates', 'App\Http\Controllers\ClienteController@create2') ->name('cliente.create2');
Route::post('/clientes', 'App\Http\Controllers\ClienteController@store') ->name('cliente.store');
Route::post('/cliente', 'App\Http\Controllers\ClienteController@storeCliente') ->name('cliente.storeCliente');
Route::get('/clientes/{cliente}/edit', 'App\Http\Controllers\ClienteController@edit') -> name('cliente.edit');
Route::put('/clientes/{cliente}', 'App\Http\Controllers\ClienteController@update')->name('cliente.update');
Route::delete('/clientes/{cliente}/delete', 'App\Http\Controllers\ClienteController@destroy') -> name('cliente.destroy');
Route::get('/clientes/{cliente}', 'App\Http\Controllers\ClienteController@show') ->name('cliente.show');

//Informes
Route::get('/informes', 'App\Http\Controllers\VentaController@informes')->name('informes');
Route::get('/informes/articulos-mas-vendidos', 'App\Http\Controllers\ProductoController@cotizado')->name('informes.articuloCotizado');
Route::get('/informes/clientes-frecuentes', 'App\Http\Controllers\ClienteController@frecuentes')->name('informes.clientesFrecuentes');
Route::get('/informes/cotizaciones', 'App\Http\Controllers\CotizacionController@Listado')->name('informes.cotizaciones');
Route::post('/informes/cotizaciones', 'App\Http\Controllers\CotizacionController@informesBuscar') ->name('cotizaciones.buscarcotizacion');
Route::get('/cotizaciones/{cotizacion}', 'App\Http\Controllers\CotizacionController@show') -> name('cotizaciones.show');

//Ventas
Route::get('/ventas/invoice', 'App\Http\Controllers\VentaController@invoice')->name('ventas.invoice');
Route::get('/ventas', 'App\Http\Controllers\VentaController@index')->name('ventas');
Route::post('/ventas/invoice/download', 'App\Http\Controllers\VentaController@export') -> name('ventas.export');
Route::get('/ventas/{venta}', 'App\Http\Controllers\VentaController@show') -> name('ventas.detalle');
Route::get('/ventas/num-venta/detalle', 'App\Http\Controllers\VentaController@detalleProd') -> name('ventas.detalleProd');
Route::post('/venta', 'App\Http\Controllers\VentaController@buscar') ->name('ventas.buscar');
Route::post('/ventas', 'App\Http\Controllers\VentaController@rechazar') ->name('ventas.rechazar');
Route::post('/ventas/crear_venta', 'App\Http\Controllers\VentaController@aceptar') ->name('ventas.aceptar');
Route::post('/ventas/store', 'App\Http\Controllers\VentaController@store') -> name('ventas.store');
Route::post('/ventas/total_venta', 'App\Http\Controllers\VentaController@totalventa') -> name('ventas.total');

Route::post('/ventas/descarga', 'App\Http\Controllers\VentaController@downloadExcel') ->name('ventas.descarga');
Route::put('/ventas/{venta}', 'App\Http\Controllers\VentaController@update')->name('ventas.update');

//DetalleVentas
Route::get('/detalles_ventas/store', 'App\Http\Controllers\DetalleVentaController@store') -> name('detallesventas.store');

//Facturas
Route::get('/facturas', 'App\Http\Controllers\FacturaController@index')->name('facturas');
Route::get('/facturas/create', 'App\Http\Controllers\FacturaController@create')->name('facturas.create');
Route::get('/facturas/{factura}/', 'App\Http\Controllers\FacturaController@edit')->name('facturas.edit');
Route::post('/facturas/store', 'App\Http\Controllers\FacturaController@store') -> name('facturas.store');
Route::put('/facturas/{factura}', 'App\Http\Controllers\FacturaController@update')->name('facturas.update');
Route::post('/facturas', 'App\Http\Controllers\FacturaController@buscar')->name('facturas.buscar');





