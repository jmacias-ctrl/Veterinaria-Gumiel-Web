<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsumosMedicosController;

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

Route::get('admin/roles', [App\Http\Controllers\UserController::class, 'index_roles'])->name('admin.roles.index');
Route::get('admin/roles/add', [App\Http\Controllers\UserController::class, 'add_rol'])->name('admin.roles.add');
Route::post('admin/roles/store', [App\Http\Controllers\UserController::class, 'store_rol'])->name('admin.roles.store');
Route::get('admin/roles/modify/{id}', [App\Http\Controllers\UserController::class, 'modify_rol'])->name('admin.roles.modify');
Route::post('admin/roles/update', [App\Http\Controllers\UserController::class, 'update_rol'])->name('admin.roles.update');
Route::post('admin/roles/delete', [App\Http\Controllers\UserController::class, 'delete_rol'])->name('admin.roles.delete');

Route::get('admin/insumosmedicos',[App\Http\Controllers\InsumosMedicosController::class,'index_insumos'])->name('admin.insumos_medicos.index');
Route::get('admin/insumosmedicos/create',[App\Http\Controllers\InsumosMedicosController::class,'create'])->name('admin.insumos_medicos.create');
Route::post('admin/insumosmedicos/store',[App\Http\Controllers\InsumosMedicosController::class,'store'])->name('admin.insumos_medicos.store');
Route::post('admin/insumosmedicos/delete',[App\Http\Controllers\InsumosMedicosController::class,'delete'])->name(('admin.insumos_medicos,delete'));


Route::get('admin/tipoinsumos',[\App\Http\Controllers\TipoinsumosController::class,'index_tipo'])->name('admin.tipoinsumos.index');
Route::get('admin/tipoinsumos/create',[\App\Http\Controllers\TipoinsumosController::class,'create'])->name('admin.tipoinsumos.create');
Route::post('admin/tipoinsumos/store',[\App\Http\Controllers\TipoinsumosController::class,'store_tipo'])->name('admin.tipoinsumos.store');
Route::get('admin/tipoinsumos/edit',[\App\Http\Controllers\TipoinsumosController::class,'edit'])->name('admin.tipoinsumos.edit');
Route::post('admin/tipoinsumos/delete',[\App\Http\Controllers\TipoinsumosController::class,'delete'])->name('admin.tipoinsumos.delete');
Route::post('admin/tipoinsumos/update',[\App\Http\Controllers\TipoinsumosController::class,'update'])->name('admin.tipoinsumos.update');

