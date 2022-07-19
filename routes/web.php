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

require __DIR__.'/auth.php';

/* rutas de cliente */
    Route::resource('cliente', App\Http\Controllers\admin\clienteController::class)->names([
        'index' => 'cliente',
        'create' => 'cliente.crear',
        'store' => 'cliente.guardar',
        'show' => 'cliente.detalle',
        'edit' => 'cliente.editar',
        'update' => 'cliente.actualizar',
        'destroy' => 'cliente.eliminar',
    ])->middleware('auth');  
    Route::get('cliente.listar{page?}','admin\clienteController@listar')->name('cliente.listar');
/* rutas de cliente */

/* rutas de domiciliario */
    Route::resource('domiciliario', App\Http\Controllers\admin\domiciliarioController::class)->names([
        'index' => 'domiciliario',
        'create' => 'domiciliario.crear',
        'store' => 'domiciliario.guardar',
        'show' => 'domiciliario.detalle',
        'edit' => 'domiciliario.editar',
        'update' => 'domiciliario.actualizar',
        'destroy' => 'domiciliario.eliminar',
    ])->middleware('auth');
    Route::get('domiciliario.listar{page?}','admin\domiciliarioController@listar')->name('domiciliario.listar');
/* rutas de domiciliario */

/* rutas de categoria */
    Route::resource('categoria', App\Http\Controllers\admin\categoriaController::class)->names([
        'index' => 'categoria',
        'create' => 'categoria.crear',
        'store' => 'categoria.guardar',
        'show' => 'categoria.detalle',
        'edit' => 'categoria.editar',
        'update' => 'categoria.actualizar',
        'destroy' => 'categoria.eliminar',
    ])->middleware('auth'); 
    Route::get('categoria.listar{page?}','admin\categoriaController@listar')->name('categoria.listar');
/* rutas de categoria */

/* rutas de subCategoria */
    Route::resource('subCategoria', App\Http\Controllers\admin\SubCategoriaController::class)->names([
        'index' => 'subCategoria',
        'create' => 'subCategoria.crear',
        'store' => 'subCategoria.guardar',
        'show' => 'subCategoria.detalle',
        'edit' => 'subCategoria.editar',
        'update' => 'subCategoria.actualizar',
        'destroy' => 'subCategoria.eliminar',
    ])->middleware('auth'); 
    Route::get('subCategoria.listar{page?}','admin\SubCategoriaController@listar')->name('subCategoria.listar');
    Route::get('subCategoria.categoria','admin\subCategoriaController@categoria')->name('subCategoria.categoria');
    
/* rutas de subCategoria */

/* rutas de plato */
    Route::resource('plato', App\Http\Controllers\admin\PlatoController::class)->names([
        'index' => 'plato',
        'create' => 'plato.crear',
        'store' => 'plato.guardar',
        'show' => 'plato.detalle',
        'edit' => 'plato.editar',
        'update' => 'plato.actualizar',
        'destroy' => 'plato.eliminar',
    ])->middleware('auth'); 
    Route::get('plato.listar{page?}','admin\platoController@listar')->name('plato.listar');
    Route::get('plato.subCategoria','admin\platoController@subCategoria')->name('plato.subCategoria');
    
/* rutas de plato */