<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController;

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
    return redirect()->action([TiendaController::class, 'index']);
});

Auth::routes();

Route::resource('tiendas', App\Http\Controllers\TiendaController::class)->middleware('auth');
Route::get('tiendas/{id}/actualizar',[App\Http\Controllers\TiendaController::class,'actualizar'])->name('tiendas.actualizar');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
