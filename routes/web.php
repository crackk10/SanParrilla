<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('theme/lte/layout');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

/* rutas de cliente */
Route::resource('cliente', App\Http\Controllers\admin\clienteController::class)->names([
    'index' => 'cliente',
    'store' => 'cliente.guardar',
    'edit' => 'cliente.editar',
    'update' => 'cliente.actualizar',
    'destroy' => 'cliente.eliminar',
])->middleware('auth');
Route::get('cliente.listar{page?}', 'admin\clienteController@listar')->name('cliente.listar');
/* rutas de cliente */
/* rutas de domiciliario */
Route::resource('domiciliario', App\Http\Controllers\admin\domiciliarioController::class)->names([
    'index' => 'domiciliario',
    'store' => 'domiciliario.guardar',
    'edit' => 'domiciliario.editar',
    'update' => 'domiciliario.actualizar',
    'destroy' => 'domiciliario.eliminar',
])->middleware('auth');
Route::get('domiciliario.listar{page?}', 'admin\domiciliarioController@listar')->name('domiciliario.listar');
/* rutas de domiciliario */
/* rutas de categoria */
Route::resource('categoria', App\Http\Controllers\admin\categoriaController::class)->names([
    'index' => 'categoria',
    'store' => 'categoria.guardar',
    'edit' => 'categoria.editar',
    'update' => 'categoria.actualizar',
    'destroy' => 'categoria.eliminar',
])->middleware('auth');
Route::get('categoria.listar{page?}', 'admin\categoriaController@listar')->name('categoria.listar');
/* rutas de categoria */
/* rutas de subCategoria */
Route::resource('subCategoria', App\Http\Controllers\admin\SubCategoriaController::class)->names([
    'index' => 'subCategoria',
    'store' => 'subCategoria.guardar',
    'edit' => 'subCategoria.editar',
    'update' => 'subCategoria.actualizar',
    'destroy' => 'subCategoria.eliminar',
])->middleware('auth');
Route::get('subCategoria.listar{page?}', 'admin\SubCategoriaController@listar')->name('subCategoria.listar');
Route::get('subCategoria.categoria', 'admin\subCategoriaController@categoria')->name('subCategoria.categoria');
/* rutas de subCategoria */
/* rutas de plato */
Route::resource('plato', App\Http\Controllers\admin\PlatoController::class)->names([
    'index' => 'plato',
    'store' => 'plato.guardar',
    'edit' => 'plato.editar',
    'update' => 'plato.actualizar',
    'destroy' => 'plato.eliminar',
])->middleware('auth');
Route::get('plato.listar{page?}', 'admin\platoController@listar')->name('plato.listar');
Route::get('plato.subCategoria', 'admin\platoController@subCategoria')->name('plato.subCategoria');
/* rutas de plato */
/* rutas de adicional */
Route::resource('adicional', App\Http\Controllers\admin\AdicionalController::class)->names([
    'index' => 'adicional',
    'store' => 'adicional.guardar',
    'edit' => 'adicional.editar',
    'update' => 'adicional.actualizar',
    'destroy' => 'adicional.eliminar',
])->middleware('auth');
Route::get('adicional.listar{page?}', 'admin\adicionalController@listar')->name('adicional.listar');
Route::get('adicional.subCategoria', 'admin\adicionalController@subCategoria')->name('adicional.subCategoria');
/* rutas de adicional */
/* rutas pedido */
Route::resource('pedido', App\Http\Controllers\admin\pedidoController::class)->names([
    'index' => 'pedido',
    'create' => 'pedido.crear',
    'store' => 'pedido.guardar',
    'show' => 'pedido.detalle',
    'edit' => 'pedido.editar',
    'update' => 'pedido.actualizar',
    'destroy' => 'pedido.eliminar',
])->middleware('auth');
Route::get('pedido.buscarPlatos', 'admin\pedidoController@buscarPlatos')->name('pedido.buscarPlatos');
Route::get('pedido.cliente{page?}', 'admin\pedidoController@cliente')->name('pedido.cliente');
Route::get('pedido.tipoPago', 'admin\pedidoController@tipoPago')->name('pedido.tipoPago');
Route::get('pedido.tipoPedido', 'admin\pedidoController@tipoPedido')->name('pedido.tipoPedido');
/* rutas de pedido */
/* rutas de carrito */
Route::post('carrito.addPlatoCarrito', 'admin\carritoController@addPlatoCarrito')->name('carrito.addPlatoCarrito');
Route::post('carrito.eliminarPlatoCarrito', 'admin\carritoController@eliminarPlatoCarrito')->name('carrito.eliminarPlatoCarrito');
Route::post('carrito.eliminarAdicionalCarrito', 'admin\carritoController@eliminarAdicionalCarrito')->name('carrito.eliminarAdicionalCarrito');
Route::post('carrito.vaciarCarrito', 'admin\carritoController@vaciarCarrito')->name('carrito.vaciarCarrito');
/* rutas de carrito */