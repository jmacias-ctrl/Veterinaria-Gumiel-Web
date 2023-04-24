<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsumosMedicosController;
use App\Http\Controllers\MarcaproductoController;
use App\Http\Controllers\ProductosVentaController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
// Route::get('/', 'LandingPageController@index');
// Route::get('/welcome', 'LandingPageController@index');
// Route::get('/landing', 'LandingPageController@index')->middleware('web');

Route::get('/',[LandingPageController::class,'index']);
Route::get('/welcome',[LandingPageController::class,'index']);
Route::get('/landing',[LandingPageController::class,'index']);



// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => ['permission:acceder panel']], function () {
    Route::get('/home', function () {
        return view('admin.home');
    })->name('home');
    Route::get('usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('admin.usuarios.index')->middleware(['role:Admin']);
    Route::post('usuarios/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('admin.usuarios.delete')->middleware(['role:Admin']);
    Route::get('usuarios/roles/{id}', [App\Http\Controllers\UserController::class, 'modify_roles'])->name('admin.usuarios.roles')->middleware(['role:Admin']);
    Route::get('usuarios/add', [App\Http\Controllers\UserController::class, 'add_user'])->name('admin.usuarios.add')->middleware(['role:Admin']);
    Route::post('usuarios/store', [App\Http\Controllers\UserController::class, 'store_user'])->name('admin.usuarios.store')->middleware(['role:Admin']);
    Route::post('usuarios/roles/update', [App\Http\Controllers\UserController::class, 'update_roles'])->name('admin.usuarios.update.roles')->middleware(['role:Admin']);

    Route::get('roles', [App\Http\Controllers\UserController::class, 'index_roles'])->name('admin.roles.index')->middleware(['role:Admin']);
    Route::get('roles/add', [App\Http\Controllers\UserController::class, 'add_rol'])->name('admin.roles.add')->middleware(['role:Admin']);
    Route::post('roles/store', [App\Http\Controllers\UserController::class, 'store_rol'])->name('admin.roles.store')->middleware(['role:Admin']);
    Route::get('roles/modify/{id}', [App\Http\Controllers\UserController::class, 'modify_rol'])->name('admin.roles.modify')->middleware(['role:Admin']);
    Route::post('roles/update', [App\Http\Controllers\UserController::class, 'update_rol'])->name('admin.roles.update')->middleware(['role:Admin']);
    Route::post('roles/delete', [App\Http\Controllers\UserController::class, 'delete_rol'])->name('admin.roles.delete')->middleware(['role:Admin']);
    Route::get('roles/permission/{id}', [App\Http\Controllers\UserController::class, 'modify_permissions_role'])->name('admin.roles.permission')->middleware(['role:Admin']);
    Route::post('roles/permission/update', [App\Http\Controllers\UserController::class, 'update_permissions_role'])->name('admin.role.update.permissions')->middleware(['role:Admin']);

    Route::get('notification/getUpdate', [App\Http\Controllers\UserController::class, 'get_notifications_count'])->name('users.notification.updateNotificationCount');
    Route::get('notification', [App\Http\Controllers\UserController::class, 'get_notifications'])->name('users.notification.index');
    Route::post('notification/delete', [App\Http\Controllers\UserController::class, 'delete_notification'])->name('users.notification.delete');
    
    Route::get('insumosmedicos', [App\Http\Controllers\InsumosMedicosController::class, 'index_insumos'])->name('admin.insumos_medicos.index')->middleware(['permission:ver insumos medicos']);
    Route::get('insumosmedicos/create', [App\Http\Controllers\InsumosMedicosController::class, 'create'])->name('admin.insumos_medicos.create')->middleware(['permission:crear insumos medicos']);
    Route::post('insumosmedicos/store', [App\Http\Controllers\InsumosMedicosController::class, 'store'])->name('admin.insumos_medicos.store')->middleware(['permission:crear insumos medicos']);
    Route::post('insumosmedicos/delete', [App\Http\Controllers\InsumosMedicosController::class, 'delete'])->name(('admin.insumos_medicos,delete'))->middleware(['permission:eliminar insumos medicos']);
    // Route::get('insumosmedicos/tipoinsumos/{id}', [App\Http\Controllers\InsumosMedicosController::class, 'modify_roles'])->name('admin.usuarios.roles');

    Route::get('tipoinsumos', [\App\Http\Controllers\TipoinsumosController::class, 'index_tipo'])->name('admin.tipoinsumos.index')->middleware(['permission:ver insumos medicos']);
    Route::get('tipoinsumos/create', [\App\Http\Controllers\TipoinsumosController::class, 'create'])->name('admin.tipoinsumos.create')->middleware(['permission:crear insumos medicos']);
    Route::post('tipoinsumos/store', [\App\Http\Controllers\TipoinsumosController::class, 'store_tipo'])->name('admin.tipoinsumos.store')->middleware(['permission:crear insumos medicos']);
    Route::get('tipoinsumos/edit', [\App\Http\Controllers\TipoinsumosController::class, 'edit'])->name('admin.tipoinsumos.edit')->middleware(['permission:editar insumos medicos']);
    Route::post('tipoinsumos/delete', [\App\Http\Controllers\TipoinsumosController::class, 'delete'])->name('admin.tipoinsumos.delete')->middleware(['permission:eliminar insumos medicos']);
    Route::post('tipoinsumos/update', [\App\Http\Controllers\TipoinsumosController::class, 'update'])->name('admin.tipoinsumos.update')->middleware(['permission:modificar insumos medicos']);

    Route::get('marcaproductos', [\App\Http\Controllers\MarcaproductoController::class, 'index_marca'])->name('admin.marcaproductos.index')->middleware(['permission:ver productos']);
    Route::get('marcaproductos/create', [\App\Http\Controllers\MarcaproductoController::class, 'create'])->name('admin.marcaproductos.create')->middleware(['permission:crear productos']);
    Route::post('marcaproductos/delete', [\App\Http\Controllers\MarcaproductoController::class, 'delete'])->name('admin.marcaproductos.delete')->middleware(['permission:eliminar productos']);
    Route::post('marcaproductos/store', [\App\Http\Controllers\MarcaproductoController::class, 'store'])->name('admin.marcaproductos.store')->middleware(['permission:crear productos']);
    Route::get('marcaproductos/edit', [\App\Http\Controllers\MarcaproductoController::class, 'edit'])->name('admin.marcaproductos.edit')->middleware(['permission:editar productos']);
    Route::post('marcaproductos/update', [\App\Http\Controllers\MarcaproductoController::class, 'update'])->name('admin.marcaproductos.update')->middleware(['permission:editar productos']);

    Route::get('productos', [App\Http\Controllers\ProductosVentaController::class, 'index_productos'])->name('productos.index')->middleware(['permission:ver productos']);
    Route::post('productos/{id}', [App\Http\Controllers\ProductosVentaController::class, 'destroy'])->name('productos.delete')->middleware(['permission:eliminar productos']);
    Route::post('productos/store', [App\Http\Controllers\ProductosVentaController::class, 'store'])->name('productos.store')->middleware(['permission:crear productos']);
    Route::post('productos', [App\Http\Controllers\ProductosVentaController::class, 'update'])->name('productos.put')->middleware(['permission:crear productos']);

    Route::get('perfil', [App\Http\Controllers\UserController::class, 'user_profile'])->name('user.profile.index');
    Route::get('perfil/edit', [App\Http\Controllers\UserController::class, 'modify_user_profile'])->name('user.profile.modify');
    Route::post('perfil/update', [App\Http\Controllers\UserController::class, 'update_user_profile'])->name('user.profile.update');
});
route::get('correo_test', function () {
    return view('emails.usuario_eliminado');
});
Auth::routes();
Route::get('/marca',[MarcasController::class,'index'])->name('marcas');
Route::post('/marca',[MarcasController::class,'store'])->name('marcas');

Route::get('/marca/{id}',[MarcasController::class,'show'])->name('marcas-edit');
Route::patch('/marca/{id}',[MarcasController::class,'update'])->name('marcas-update');
Route::delete('/marca/{id}',[MarcasController::class,'destroy'])->name('marcas-destroy');
