<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\GameController;

Route::get('/', function () { return view('index');});
Route::post('/formulario', 'App\Http\Controllers\Controlador@form')->name('formulario');
Route::get('/pagina2/{nome}', 'App\Http\Controllers\Controlador@pagina2');
//Route::post ('/pagina2', 'App\Http\Controllers\Controlador@formNumero' )->name('formNumero');
Route::get('/pagina3/{nome}/{idade}', 'App\Http\Controllers\Controlador@pagina3')->name('pagina3');


