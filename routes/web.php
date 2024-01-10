<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\GameController;


Route::get('/', 'App\Http\Controllers\GameController@index')->name('index');

Route::post('/formulario', [GameController::class, 'form'])->name('formulario');
// Route::get('/pagina2/{nome}', [GameController::class, 'pagina2']);
Route::post('/pagina2', [GameController::class, 'formNumero'])->name('formNumero');
Route::get('/pagina3', [GameController::class, 'pagina3'])->name('pagina3');
Route::post('/pagina3', [GameController::class, 'verificarTenta'])->name('verificarTenta');

Route::match(['get', 'post'], '/pagina4', [GameController::class, 'pagina4'])->name('pagina4');



