<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\LandingPageController;

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

// Route::get('/', 'LandingPageController@index');
// Route::get('/welcome', 'LandingPageController@index');
// Route::get('/landing', 'LandingPageController@index')->middleware('web');

Route::get('/',[LandingPageController::class,'index']);
Route::get('/welcome',[LandingPageController::class,'index']);
Route::get('/landing',[LandingPageController::class,'index']);



// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/marca',[MarcasController::class,'index'])->name('marcas');
Route::post('/marca',[MarcasController::class,'store'])->name('marcas');

Route::get('/marca/{id}',[MarcasController::class,'show'])->name('marcas-edit');
Route::patch('/marca/{id}',[MarcasController::class,'update'])->name('marcas-update');
Route::delete('/marca/{id}',[MarcasController::class,'destroy'])->name('marcas-destroy');
