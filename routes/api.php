<?php

use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::get('users', function (){
    return datatables()
        ->eloquent(App\User::query())
        ->toJson();

}); */

//Route::get('paginas', function (){
    //TODO
	//return App\Models\User::all();
/*  return view(Tienda);  */
    //return datatable()->eloquent(App\User::query())->toJson();
//});