<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\InsumosMedicosController;
use App\Http\Controllers\MarcaproductoController;
use App\Http\Controllers\ProductosVentaController;
use App\Http\Controllers\LandingPageController;
use app\Http\Controllers\CartController;

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

Route::get('/',[LandingPageController::class,'index'])->name('inicio');



Route::get('/verCalendario', function () {
    return view('verCalendario');
})->middleware('web');
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => ['permission:acceder panel']], function () {

    Route::get('usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('admin.usuarios.index')->middleware(['role:Admin']);
    Route::post('usuarios/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('admin.usuarios.delete')->middleware(['role:Admin']);
    Route::get('usuarios/roles/{id}', [App\Http\Controllers\UserController::class, 'modify_roles'])->name('admin.usuarios.roles')->middleware(['role:Admin']);
    Route::get('usuarios/add', [App\Http\Controllers\UserController::class, 'add_user'])->name('admin.usuarios.add')->middleware(['role:Admin']);
    Route::post('usuarios/store', [App\Http\Controllers\UserController::class, 'store_user'])->name('admin.usuarios.store')->middleware(['role:Admin']);
    Route::post('usuarios/roles/update', [App\Http\Controllers\UserController::class, 'update_roles'])->name('admin.usuarios.update.roles')->middleware(['role:Admin']);

    Route::get('/home', [\App\Http\Controllers\HorarioController::class, 'index'])->name('home');

    Route::get('/shop', [\App\Http\Controllers\CartController::class, 'shop'])->name('shop.shop');
    Route::get('shop/cart', [\App\Http\Controllers\CartController::class, 'cart'])->name('shop.cart.index');
    Route::post('/add', [\App\Http\Controllers\CartController::class, 'add'])->name('shop.cart.store');
    Route::get('shop/show/{id}', [\App\Http\Controllers\CartController::class, 'show'])->name('shop.show');
    Route::post('/update', [\App\Http\Controllers\CartController::class, 'update'])->name('shop.cart.update');
    Route::post('/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('shop.cart.remove');
    Route::post('/clear', [\App\Http\Controllers\CartController::class, 'clear'])->name('shop.cart.clear');    


    Route::get('admin/marcaInsumos', [\App\Http\Controllers\MarcaInsumoController::class, 'index_marca'])->name('admin.marcaInsumos.index');
    Route::get('admin/marcaInsumos/create', [\App\Http\Controllers\MarcaInsumoController::class, 'create'])->name('admin.marcaInsumos.create');
    Route::post('admin/marcaInsumos/delete', [\App\Http\Controllers\MarcaInsumoController::class, 'delete'])->name('admin.marcaInsumos.delete');
    Route::post('admin/marcaInsumos/store', [\App\Http\Controllers\MarcaInsumoController::class, 'store'])->name('admin.marcaInsumos.store');
    Route::get('admin/marcaInsumos/edit', [\App\Http\Controllers\MarcaInsumoController::class, 'edit'])->name('admin.marcaInsumos.edit');
    Route::post('admin/marcaInsumos/update', [\App\Http\Controllers\MarcaInsumoController::class, 'update'])->name('admin.marcaInsumos.update');
    Route::post('admin/marcaInsumos/update', [\App\Http\Controllers\MarcaInsumoController::class, 'update'])->name('admin.marcaInsumos.update');


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
    
    Route::get('insumos_medicos', [App\Http\Controllers\InsumosMedicosController::class, 'index_insumos'])->name('admin.insumos_medicos.index');
    Route::get('insumos_medicos/create', [App\Http\Controllers\InsumosMedicosController::class, 'create'])->name('admin.insumos_medicos.create');
    Route::get('insumos_medicos/edit/{id}', [App\Http\Controllers\InsumosMedicosController::class, 'edit'])->name('admin.insumos_medicos.edit');
    Route::post('insumos_medicos/update', [App\Http\Controllers\InsumosMedicosController::class, 'update'])->name('admin.insumos_medicos.update');
    Route::post('insumos_medicos/store', [App\Http\Controllers\InsumosMedicosController::class, 'store'])->name('admin.insumos_medicos.store');
    Route::post('insumos_medicos/delete', [App\Http\Controllers\InsumosMedicosController::class, 'delete'])->name(('admin.insumos_medicos.delete'));
    // Route::get('insumosmedicos/tipoinsumos/{id}', [App\Http\Controllers\InsumosMedicosController::class, 'modify_roles'])->name('admin.usuarios.roles');

    Route::get('tipo_insumos', [\App\Http\Controllers\TipoinsumosController::class, 'index_tipo'])->name('admin.tipoinsumos.index');
    Route::get('tipo_insumos/create', [\App\Http\Controllers\TipoinsumosController::class, 'create'])->name('admin.tipoinsumos.create');
    Route::post('tipo_insumos/store', [\App\Http\Controllers\TipoinsumosController::class, 'store_tipo'])->name('admin.tipoinsumos.store');
    Route::get('tipo_insumos/edit', [\App\Http\Controllers\TipoinsumosController::class, 'edit'])->name('admin.tipoinsumos.edit');
    Route::post('tipo_insumos/delete', [\App\Http\Controllers\TipoinsumosController::class, 'delete'])->name('admin.tipoinsumos.delete');
    Route::post('tipo_insumos/update', [\App\Http\Controllers\TipoinsumosController::class, 'update'])->name('admin.tipoinsumos.update');

    Route::get('marca_productos', [\App\Http\Controllers\MarcaproductoController::class, 'index_marca'])->name('admin.marcaproductos.index')->middleware(['permission:ver productos']);
    Route::get('marca_productos/create', [\App\Http\Controllers\MarcaproductoController::class, 'create'])->name('admin.marcaproductos.create')->middleware(['permission:crear productos']);
    Route::post('marca_productos/delete', [\App\Http\Controllers\MarcaproductoController::class, 'delete'])->name('admin.marcaproductos.delete')->middleware(['permission:eliminar productos']);
    Route::post('marca_productos/store', [\App\Http\Controllers\MarcaproductoController::class, 'store'])->name('admin.marcaproductos.store')->middleware(['permission:ver productos']);
    Route::get('marca_productos/edit', [\App\Http\Controllers\MarcaproductoController::class, 'edit'])->name('admin.marcaproductos.edit')->middleware(['permission:editar productos']);
    Route::post('marca_productos/update', [\App\Http\Controllers\MarcaproductoController::class, 'update'])->name('admin.marcaproductos.update')->middleware(['permission:editar productos']);

    Route::get('perfil', [App\Http\Controllers\UserController::class, 'user_profile'])->name('user.profile.index');
    Route::get('perfil/edit', [App\Http\Controllers\UserController::class, 'modify_user_profile'])->name('user.profile.modify');
    Route::post('perfil/update', [App\Http\Controllers\UserController::class, 'update_user_profile'])->name('user.profile.update');
    Route::get('horario',[App\Http\Controllers\HorariosController::class, 'index'])->name('admin.horario.index');
    Route::post('horario/store',[App\Http\Controllers\HorariosController::class, 'store'])->name('admin.horario.store');
    Route::get('admin/horario/add',[App\Http\Controllers\HorariosController::class, 'add'])->name('admin.horario.add');
    Route::get('admin/horario/show',[App\Http\Controllers\HorariosController::class, 'show']);
    Route::post('admin/horario/edit/{id}',[App\Http\Controllers\HorariosController::class,'edit']);
    Route::post('admin/horario/delete/{id}',[App\Http\Controllers\HorariosController::class,'delete']);
    Route::post('admin/horario/actualizar/{horarios}',[App\Http\Controllers\HorariosController::class,'update']);

    Route::get('servicio', [App\Http\Controllers\ServicioController::class, 'index'])->name('admin.servicio');

    Route::get('admin/productos', [App\Http\Controllers\ProductosVentaController::class, 'index_productos'])->name('productos.index');
    Route::get('productos/{id}', [App\Http\Controllers\ProductosVentaController::class, 'index_productos'])->name('productos.ver');
    Route::delete('admin/productos/{id}', [App\Http\Controllers\ProductosVentaController::class, 'destroy'])->name('productos.delete');
    Route::post('productos/store', [App\Http\Controllers\ProductosVentaController::class, 'store'])->name('productos.store');
    Route::get('productos', [App\Http\Controllers\ProductosVentaController::class, 'create'])->name('productos.crear');
    Route::match(['put', 'post'], 'productos/{producto}', [App\Http\Controllers\ProductosVentaController::class, 'update'])->name('productos.update');
    Route::get('admin/productos/{producto}/edit',[App\Http\Controllers\ProductosVentaController::class, 'edit'])->name('productos.edit');

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
