<?php

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

Route::get('admin/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('admin.usuarios.index');
Route::post('admin/usuarios/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('admin.usuarios.delete');
Route::get('admin/usuarios/roles/{id}', [App\Http\Controllers\UserController::class, 'modify_roles'])->name('admin.usuarios.roles');
Route::get('admin/usuarios/add', [App\Http\Controllers\UserController::class, 'add_user'])->name('admin.usuarios.add');
Route::post('admin/usuarios/store', [App\Http\Controllers\UserController::class, 'store_user'])->name('admin.usuarios.store');
Route::post('admin/usuarios/roles/update', [App\Http\Controllers\UserController::class, 'update_roles'])->name('admin.usuarios.update.roles');