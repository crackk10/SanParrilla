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