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

Route::get('/', [GameController::class, 'index']);
Route::post('/formulario', [GameController::class, 'form'])->name('formulario');
Route::get('/pagina2/{nome}/{idade}', [GameController::class, 'showPagina2'])->name('pagina2');
Route::get('/pagina3/{nome}/{idade}', [GameController::class, 'showPagina3'])->name('pagina3');
