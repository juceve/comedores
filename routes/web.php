<?php

use App\Http\Controllers\CategoriaproductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\FranjaController;
use App\Http\Controllers\ProductoController;
use App\Http\Livewire\Entregas\Diario;
use App\Http\Livewire\Entregas\Productosxempresas;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('franjas',FranjaController::class)->middleware('auth')->names('franjas');
Route::resource('clientes',ClienteController::class)->middleware('auth')->names('clientes');
Route::resource('entregas',EntregaController::class)->middleware('auth')->names('entregas');
Route::get('reporte.diario',Diario::class)->middleware('auth')->name('diario');

Route::resource('categorias', CategoriaproductoController::class)->middleware('auth')->names('categoriaproductos');
Route::resource('productos', ProductoController::class)->middleware('auth')->names('productos');
Route::get('reporte.prodxemp', Productosxempresas::class)->name('productosxempresas');