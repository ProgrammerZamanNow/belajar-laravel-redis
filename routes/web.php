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

Route::get('/session/new', [\App\Http\Controllers\SessionController::class, "set"]);
Route::get('/session/get', [\App\Http\Controllers\SessionController::class, "get"]);

Route::get('/', function () {
    return view('welcome');
});
