<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\FranjaController;
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
Route::resource('franjas',FranjaController::class)->names('franjas');
Route::resource('clientes',ClienteController::class)->names('clientes');
Route::resource('entregas',EntregaController::class)->names('entregas');
