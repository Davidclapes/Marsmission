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
Route::get('/', [App\Http\Controllers\Controller::class,'index']);
Route::get('/introduccio',[App\Http\Controllers\RoverController::class,'formulari']);
Route::post('/calculamoviment',[App\Http\Controllers\RoverController::class,'calculaMoviment']);