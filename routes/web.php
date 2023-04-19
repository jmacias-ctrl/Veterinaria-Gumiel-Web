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
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware'=>['role:Admin']], function(){
    Route::get('/home', function(){
        return view('admin.home');
    })->name('home');
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
    Route::post('admin/roles/permission', [App\Http\Controllers\UserController::class, 'delete_rol'])->name('admin.roles.permission');
    Route::get('admin/notification', [App\Http\Controllers\UserController::class, 'get_notifications'])->name('users.notification.index');
    Route::post('admin/notification/delete', [App\Http\Controllers\UserController::class, 'delete_notification'])->name('users.notification.delete');
});
    route::get('correo_test', function(){
        return view('emails.usuario_eliminado');
    });
