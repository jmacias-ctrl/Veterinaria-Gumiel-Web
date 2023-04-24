<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\InsumosMedicosController;
use App\Http\Controllers\MarcaproductoController;
use App\Http\Controllers\ProductosVentaController;
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

// Route::get('/landing', function () {
//     return view('landing');
// });

Route::get('/landing', function () {
    return view('landing');
})->middleware('web');


Route::get('/verCalendario', function () {
    return view('verCalendario');
})->middleware('web');
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('/home', function () {
        return view('admin.home');
    })->name('home');

    Route::get('calendario', [\App\Http\Controllers\HorarioController::class, 'index'])->name('calendario.verCalendario.index');

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
    
    Route::get('admin/insumosmedicos', [App\Http\Controllers\InsumosMedicosController::class, 'index_insumos'])->name('admin.insumos_medicos.index');
    Route::get('admin/insumosmedicos/create', [App\Http\Controllers\InsumosMedicosController::class, 'create'])->name('admin.insumos_medicos.create');
    Route::post('admin/insumosmedicos/store', [App\Http\Controllers\InsumosMedicosController::class, 'store'])->name('admin.insumos_medicos.store');
    Route::post('admin/insumosmedicos/delete', [App\Http\Controllers\InsumosMedicosController::class, 'delete'])->name(('admin.insumos_medicos,delete'));
    // Route::get('admin/insumosmedicos/tipoinsumos/{id}', [App\Http\Controllers\InsumosMedicosController::class, 'modify_roles'])->name('admin.usuarios.roles');

    Route::get('admin/tipoinsumos', [\App\Http\Controllers\TipoinsumosController::class, 'index_tipo'])->name('admin.tipoinsumos.index');
    Route::get('admin/tipoinsumos/create', [\App\Http\Controllers\TipoinsumosController::class, 'create'])->name('admin.tipoinsumos.create');
    Route::post('admin/tipoinsumos/store', [\App\Http\Controllers\TipoinsumosController::class, 'store_tipo'])->name('admin.tipoinsumos.store');
    Route::get('admin/tipoinsumos/edit', [\App\Http\Controllers\TipoinsumosController::class, 'edit'])->name('admin.tipoinsumos.edit');
    Route::post('admin/tipoinsumos/delete', [\App\Http\Controllers\TipoinsumosController::class, 'delete'])->name('admin.tipoinsumos.delete');
    Route::post('admin/tipoinsumos/update', [\App\Http\Controllers\TipoinsumosController::class, 'update'])->name('admin.tipoinsumos.update');

    Route::get('admin/marcaproductos', [\App\Http\Controllers\MarcaproductoController::class, 'index_marca'])->name('admin.marcaproductos.index');
    Route::get('admin/marcaproductos/create', [\App\Http\Controllers\MarcaproductoController::class, 'create'])->name('admin.marcaproductos.create');
    Route::post('admin/marcaproductos/delete', [\App\Http\Controllers\MarcaproductoController::class, 'delete'])->name('admin.marcaproductos.delete');
    Route::post('admin/marcaproductos/store', [\App\Http\Controllers\MarcaproductoController::class, 'store'])->name('admin.marcaproductos.store');
    Route::get('admin/marcaproductos/edit', [\App\Http\Controllers\MarcaproductoController::class, 'edit'])->name('admin.marcaproductos.edit');
    Route::post('admin/marcaproductos/update', [\App\Http\Controllers\MarcaproductoController::class, 'update'])->name('admin.marcaproductos.update');
    Route::post('admin/marcaproductos/update', [\App\Http\Controllers\MarcaproductoController::class, 'update'])->name('admin.marcaproductos.update');

    Route::get('admin/productos', [App\Http\Controllers\ProductosVentaController::class, 'index_productos'])->name('productos.index');
    Route::post('admin/productos/{id}', [App\Http\Controllers\ProductosVentaController::class, 'destroy'])->name('productos.delete');
    Route::post('admin/productos/store', [App\Http\Controllers\ProductosVentaController::class, 'store'])->name('productos.store');
    Route::post('admin/productos', [App\Http\Controllers\ProductosVentaController::class, 'update'])->name('productos.put');
});
route::get('correo_test', function () {
    return view('emails.usuario_eliminado');
});
Auth::routes();
