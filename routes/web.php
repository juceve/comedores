<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteturnoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\EntregasmanualeController;
use App\Http\Controllers\exportExcelController;
use App\Http\Controllers\FranjaController;
use App\Http\Controllers\MensualidadeController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ReservalunchController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Aprobaciones\RepDiario;
use App\Http\Livewire\Clienteturno\Panel;
use App\Http\Livewire\Entregas\Diario;
use App\Http\Livewire\Entregas\General;
use App\Http\Livewire\Entregas\Manuales;
use App\Http\Livewire\Entregas\Productosxempresas;
use App\Http\Livewire\Turno\Config;
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

Route::resource('users',UserController::class)->only(['index','edit','update'])->names('users');
Route::resource('roles',RoleController::class)->names('roles');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::resource('franjas',FranjaController::class)->middleware('auth')->names('franjas');
Route::resource('clientes',ClienteController::class)->middleware('auth')->names('clientes');

Route::get('entregas',[EntregaController::class,'index'])->middleware('can:entregas.index')->name('entregas');
Route::get('entregasmanuales',Manuales::class)->middleware('can:entregas.entregasmanuales')->name('entregasmanuales');
// Route::get('excel/entregasdiarias',[exportExcelController::class,'exportEntregasDiaria'])->name('excel.entregasDiarias');

Route::resource('turnos',TurnoController::class)->names('turnos');
Route::get('turnos.config/{id}',Config::class)->middleware('can:turnos.edit')->name('turnos.config');
Route::get('clienteturnos',Panel::class)->middleware('can:clientesturnos.listado')->name('clienteturnos');

Route::resource('reservas',ReservaController::class)->names('reservas');
Route::post('approved/{id}', [ReservaController::class,'approved'])->name('approved');
Route::post('approveds', [ReservaController::class,'approvedAll'])->name('approvedAll');

Route::resource('empresas',EmpresaController::class)->names('empresas');

Route::get('reporte.prodxemp', Productosxempresas::class)->name('productosxempresas');
Route::get('reporte.general', General::class)->name('general');
Route::get('reporte.diario',Diario::class)->middleware('auth')->name('diario');
Route::get('reporte.aprobaciones',RepDiario::class)->name('repdiario');

Route::resource('mensualidades', MensualidadeController::class)->names('mensualidades');
