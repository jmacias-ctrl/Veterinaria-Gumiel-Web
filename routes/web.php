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

Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

// Route::get('/', 'LandingPageController@index');
// Route::get('/welcome', 'LandingPageController@index');
// Route::get('/landing', 'LandingPageController@index')->middleware('web');

Route::get('/', [LandingPageController::class, 'index'])->name('inicio');
Route::post('/contactanos', [landingPageController::class, "store"])->name('contactanos.store');

Route::get('/verCalendario', function () {
    return view('verCalendario');
})->name("verCalendario")->middleware('web');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['can:ver productos']], function () {
    Route::get('marca_productos', [\App\Http\Controllers\MarcaproductoController::class, 'index_marca'])->name('admin.marcaproductos.index');
    Route::get('marca_productos/create', [\App\Http\Controllers\MarcaproductoController::class, 'create'])->name('admin.marcaproductos.create')->middleware(['permission:ingresar productos']);
    Route::post('marca_productos/delete', [\App\Http\Controllers\MarcaproductoController::class, 'delete'])->name('admin.marcaproductos.delete')->middleware(['permission:eliminar productos']);
    Route::post('marca_productos/store', [\App\Http\Controllers\MarcaproductoController::class, 'store'])->name('admin.marcaproductos.store')->middleware(['permission:ingresar productos']);
    Route::get('marca_productos/edit', [\App\Http\Controllers\MarcaproductoController::class, 'edit'])->name('admin.marcaproductos.edit')->middleware(['permission:modificar productos']);
    Route::post('marca_productos/update', [\App\Http\Controllers\MarcaproductoController::class, 'update'])->name('admin.marcaproductos.update')->middleware(['permission:modificar productos']);

    Route::get('productos', [App\Http\Controllers\ProductosVentaController::class, 'index_productos'])->name('productos.index');
    Route::post('productos/delete', [App\Http\Controllers\ProductosVentaController::class, 'destroy'])->name('productos.delete')->middleware(['permission:eliminar productos']);
    Route::post('productos/store', [App\Http\Controllers\ProductosVentaController::class, 'store'])->name('productos.store')->middleware(['permission:ingresar productos']);
    Route::get('productos/create', [App\Http\Controllers\ProductosVentaController::class, 'create'])->name('productos.crear')->middleware(['permission:ingresar productos']);
    Route::post('productos/update', [App\Http\Controllers\ProductosVentaController::class, 'update'])->name('productos.update')->middleware(['permission:modificar productos']);
    Route::get('productos/{id}/edit', [App\Http\Controllers\ProductosVentaController::class, 'edit'])->name('productos.edit')->middleware(['permission:modificar productos']);

    Route::get('tipoproductos_ventas', [\App\Http\Controllers\tipoproductos_ventasController::class, 'index'])->name('admin.tipoproductos_ventas.index');
    Route::get('tipoproductos_ventas/create', [\App\Http\Controllers\tipoproductos_ventasController::class, 'create'])->name('admin.tipoproductos_ventas.create');
    Route::post('tipoproductos_ventas/store', [\App\Http\Controllers\tipoproductos_ventasController::class, 'store'])->name('admin.tipoproductos_ventas.store');
    Route::get('tipoproductos_ventas/edit', [\App\Http\Controllers\tipoproductos_ventasController::class, 'edit'])->name('admin.tipoproductos_ventas.edit');
    Route::post('tipoproductos_ventas/delete', [\App\Http\Controllers\tipoproductos_ventasController::class, 'delete'])->name('admin.tipoproductos_ventas.delete');
    Route::post('tipoproductos_ventas/update', [\App\Http\Controllers\tipoproductos_ventasController::class, 'update'])->name('admin.tipoproductos_ventas.update');
});

Route::group(['middleware' => ['can:ver insumos medicos']], function () {
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

    Route::get('admin/marcaInsumos', [\App\Http\Controllers\MarcaInsumoController::class, 'index_marca'])->name('admin.marcaInsumos.index');
    Route::get('admin/marcaInsumos/create', [\App\Http\Controllers\MarcaInsumoController::class, 'create'])->name('admin.marcaInsumos.create');
    Route::post('admin/marcaInsumos/delete', [\App\Http\Controllers\MarcaInsumoController::class, 'delete'])->name('admin.marcaInsumos.delete');
    Route::post('admin/marcaInsumos/store', [\App\Http\Controllers\MarcaInsumoController::class, 'store'])->name('admin.marcaInsumos.store');
    Route::get('admin/marcaInsumos/edit', [\App\Http\Controllers\MarcaInsumoController::class, 'edit'])->name('admin.marcaInsumos.edit');
    Route::post('admin/marcaInsumos/update', [\App\Http\Controllers\MarcaInsumoController::class, 'update'])->name('admin.marcaInsumos.update');
});

Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('landingpage/edit/aboutUs', [App\Http\Controllers\LandingPageController::class, 'modify_landingpage_aboutUs'])->name('admin.landingpage_aboutUs.modify');
    Route::get('landingpage/edit/ubication', [App\Http\Controllers\LandingPageController::class, 'modify_landingpage_ubication'])->name('admin.landingpage_ubication.modify');
});

Route::group(['middleware' => ['can:acceso administracion de stock']], function () {
    Route::get('administracion-stock', [App\Http\Controllers\AdministracionInventario::class, 'index'])->name('administracion_inventario.index');
    Route::get('administracion-stock/historial', [App\Http\Controllers\AdministracionInventario::class, 'historial_admin'])->name('administracion_inventario.historial');
    Route::post('administracion-stock/realizar_admin', [App\Http\Controllers\AdministracionInventario::class, 'admin_item'])->name('administracion_inventario.realizar_admin');
    Route::get('administracion-stock/ver_item', [App\Http\Controllers\AdministracionInventario::class, 'ver_item'])->name('administracion_inventario.verItem');
    Route::get('administracion-stock/descargar_factura', [App\Http\Controllers\AdministracionInventario::class, 'descargar_factura'])->name('administracion_inventario.descargarFactura');
});

Route::group(['middleware' => ['can:ver medicamentos vacunas']], function () {
    Route::get('medicamentos_vacunas', [App\Http\Controllers\medicamentos_vacunasController::class, 'index_medicamentos_vacunas'])->name('admin.medicamentos_vacunas.index');
    Route::get('medicamentos_vacunas/create', [App\Http\Controllers\medicamentos_vacunasController::class, 'create'])->name('admin.medicamentos_vacunas.create');
    Route::get('medicamentos_vacunas/edit/{id}', [App\Http\Controllers\medicamentos_vacunasController::class, 'edit'])->name('admin.medicamentos_vacunas.edit');
    Route::post('medicamentos_vacunas/update', [App\Http\Controllers\medicamentos_vacunasController::class, 'update'])->name('admin.medicamentos_vacunas.update');
    Route::post('medicamentos_vacunas/store', [App\Http\Controllers\medicamentos_vacunasController::class, 'store'])->name('admin.medicamentos_vacunas.store');
    Route::post('medicamentos_vacunas/delete', [App\Http\Controllers\medicamentos_vacunasController::class, 'delete'])->name(('admin.medicamentos_vacunas.delete'));

    Route::get('tipo_medicamentos_vacunas', [\App\Http\Controllers\tipomedicamentos_vacunasController::class, 'index_tipo'])->name('admin.tipomedicamentos_vacunas.index');
    Route::get('tipo_medicamentos_vacunas/create', [\App\Http\Controllers\tipomedicamentos_vacunasController::class, 'create'])->name('admin.tipomedicamentos_vacunas.create');
    Route::post('tipo_medicamentos_vacunas/store', [\App\Http\Controllers\tipomedicamentos_vacunasController::class, 'store_tipo'])->name('admin.tipomedicamentos_vacunas.store');
    Route::get('tipo_medicamentos_vacunas/edit', [\App\Http\Controllers\tipomedicamentos_vacunasController::class, 'edit'])->name('admin.tipomedicamentos_vacunas.edit');
    Route::post('tipo_medicamentos_vacunas/delete', [\App\Http\Controllers\tipomedicamentos_vacunasController::class, 'delete'])->name('admin.tipomedicamentos_vacunas.delete');
    Route::post('tipo_medicamentos_vacunas/update', [\App\Http\Controllers\tipomedicamentos_vacunasController::class, 'update'])->name('admin.tipomedicamentos_vacunas.update');

    Route::get('admin/marcamedicamentos_vacunas', [\App\Http\Controllers\MarcaMedicamentoController::class, 'index_marca'])->name('admin.marcamedicamentos_vacunas.index');
    Route::get('admin/marcamedicamentos_vacunas/create', [\App\Http\Controllers\MarcaMedicamentoController::class, 'create'])->name('admin.marcamedicamentos_vacunas.create');
    Route::post('admin/marcamedicamentos_vacunas/delete', [\App\Http\Controllers\MarcaMedicamentoController::class, 'delete'])->name('admin.marcamedicamentos_vacunas.delete');
    Route::post('admin/marcamedicamentos_vacunas/store', [\App\Http\Controllers\MarcaMedicamentoController::class, 'store'])->name('admin.marcamedicamentos_vacunas.store');
    Route::get('admin/marcamedicamentos_vacunas/edit', [\App\Http\Controllers\MarcaMedicamentoController::class, 'edit'])->name('admin.marcamedicamentos_vacunas.edit');
    Route::post('admin/marcamedicamentos_vacunas/update', [\App\Http\Controllers\MarcaMedicamentoController::class, 'update'])->name('admin.marcamedicamentos_vacunas.update');
});

Route::group(['middleware' => ['can:ver especies']], function () {
    Route::get('especies', [App\Http\Controllers\EspecieController::class, 'index'])->name('admin.especies.index');
    Route::get('especies/create', [App\Http\Controllers\EspecieController::class, 'create'])->name('admin.especies.create');
    Route::get('especies/edit/{id}', [App\Http\Controllers\EspecieController::class, 'edit'])->name('admin.especies.edit');
    Route::post('especies/update', [App\Http\Controllers\EspecieController::class, 'update'])->name('admin.especies.update');
    Route::post('especies/store', [App\Http\Controllers\EspecieController::class, 'store'])->name('admin.especies.store');
    Route::post('especies/delete', [App\Http\Controllers\EspecieController::class, 'delete'])->name(('admin.especies.delete'));
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('notification/getUpdate', [App\Http\Controllers\UserController::class, 'get_notifications_count'])->name('users.notification.updateNotificationCount');
    Route::get('notification', [App\Http\Controllers\UserController::class, 'get_notifications'])->name('users.notification.index');
    Route::post('notification/delete', [App\Http\Controllers\UserController::class, 'delete_notification'])->name('users.notification.delete');

    Route::get('perfil', [App\Http\Controllers\UserController::class, 'user_profile'])->name('user.profile.index');
    Route::get('perfil/edit', [App\Http\Controllers\UserController::class, 'modify_user_profile'])->name('user.profile.modify');
    Route::post('perfil/update', [App\Http\Controllers\UserController::class, 'update_user_profile'])->name('user.profile.update');
});

Route::group(['middleware' => ['can:ver servicios']], function () {

    Route::get('servicio', [\App\Http\Controllers\ServicioController::class, 'index'])->name('admin.servicio');
    Route::get('servicio/create', [\App\Http\Controllers\ServicioController::class, 'create'])->name('admin.servicio.create');
    Route::post('servicio/store', [\App\Http\Controllers\ServicioController::class, 'store'])->name('admin.servicio.store');
    Route::get('servicio/edit', [\App\Http\Controllers\ServicioController::class, 'edit'])->name('admin.servicio.edit');
    Route::post('servicio/delete', [\App\Http\Controllers\ServicioController::class, 'delete'])->name('admin.servicio.delete');
    Route::post('servicio/update', [\App\Http\Controllers\ServicioController::class, 'update'])->name('admin.servicio.update');

    Route::get('tiposervicios', [\App\Http\Controllers\tiposerviciosController::class, 'index'])->name('admin.tiposervicios.index');
    Route::get('tiposervicios/create', [\App\Http\Controllers\tiposerviciosController::class, 'create'])->name('admin.tiposervicios.create');
    Route::post('tiposervicios/store', [\App\Http\Controllers\tiposerviciosController::class, 'store'])->name('admin.tiposervicios.store');
    Route::get('tiposervicios/edit', [\App\Http\Controllers\tiposerviciosController::class, 'edit'])->name('admin.tiposervicios.edit');
    Route::post('tiposervicios/delete', [\App\Http\Controllers\tiposerviciosController::class, 'delete'])->name('admin.tiposervicios.delete');
    Route::post('tiposervicios/update', [\App\Http\Controllers\tiposerviciosController::class, 'update'])->name('admin.tiposervicios.update');
});

Route::group(['middleware' => ['role:Admin']], function () {

    Route::get('usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('admin.usuarios.index')->middleware(['role:Admin']);
    Route::post('usuarios/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('admin.usuarios.delete')->middleware(['role:Admin']);
    Route::get('usuarios/roles/{id}', [App\Http\Controllers\UserController::class, 'modify_roles'])->name('admin.usuarios.roles')->middleware(['role:Admin']);
    Route::get('usuarios/add', [App\Http\Controllers\UserController::class, 'add_user'])->name('admin.usuarios.add')->middleware(['role:Admin']);
    Route::post('usuarios/store', [App\Http\Controllers\UserController::class, 'store_user'])->name('admin.usuarios.store')->middleware(['role:Admin']);
    Route::post('usuarios/roles/update', [App\Http\Controllers\UserController::class, 'update_roles'])->name('admin.usuarios.update.roles')->middleware(['role:Admin']);

    Route::get('/inicio/administrador', [\App\Http\Controllers\HorarioController::class, 'index'])->name('admin');

    Route::get('roles', [App\Http\Controllers\UserController::class, 'index_roles'])->name('admin.roles.index')->middleware(['role:Admin']);
    Route::get('roles/add', [App\Http\Controllers\UserController::class, 'add_rol'])->name('admin.roles.add')->middleware(['role:Admin']);
    Route::post('roles/store', [App\Http\Controllers\UserController::class, 'store_rol'])->name('admin.roles.store')->middleware(['role:Admin']);
    Route::get('roles/modify/{id}', [App\Http\Controllers\UserController::class, 'modify_rol'])->name('admin.roles.modify')->middleware(['role:Admin']);
    Route::post('roles/update', [App\Http\Controllers\UserController::class, 'update_rol'])->name('admin.roles.update')->middleware(['role:Admin']);
    Route::post('roles/delete', [App\Http\Controllers\UserController::class, 'delete_rol'])->name('admin.roles.delete')->middleware(['role:Admin']);
    Route::get('roles/permission/{id}', [App\Http\Controllers\UserController::class, 'modify_permissions_role'])->name('admin.roles.permission')->middleware(['role:Admin']);
    Route::post('roles/permission/update', [App\Http\Controllers\UserController::class, 'update_permissions_role'])->name('admin.role.update.permissions')->middleware(['role:Admin']);

    Route::get('horario', [App\Http\Controllers\HorariosController::class, 'index'])->name('admin.horario.index');
    Route::post('horario/store', [App\Http\Controllers\HorariosController::class, 'store'])->name('admin.horario.store');
    Route::get('admin/horario/add', [App\Http\Controllers\HorariosController::class, 'add'])->name('admin.horario.add');
    Route::get('admin/horario/show', [App\Http\Controllers\HorariosController::class, 'show']);
    Route::post('admin/horario/edit/{id}', [App\Http\Controllers\HorariosController::class, 'edit']);
    Route::post('admin/horario/delete/{id}', [App\Http\Controllers\HorariosController::class, 'delete']);
    Route::post('admin/horario/actualizar/{horarios}', [App\Http\Controllers\HorariosController::class, 'update']);
    //Rutas funcionarios
    Route::resource('/funcionarios', 'App\Http\Controllers\FuncionariosController');


    Route::get('/landing/ubication/edit', [\App\Http\Controllers\LandingPageController::class, 'modify_landingpage_ubication'])->name('landing.ubication.edit');
    Route::post('/landing/ubication/update', [\App\Http\Controllers\LandingPageController::class, 'update_landingpage_ubication'])->name('landing.ubication.update');

    // Route::get('perfil', [App\Http\Controllers\UserController::class, 'user_profile'])->name('user.profile.index');
    // Route::get('perfil/edit', [App\Http\Controllers\UserController::class, 'modify_user_profile'])->name('user.profile.modify');
    // Route::post('perfil/update', [App\Http\Controllers\UserController::class, 'update_user_profile'])->name('user.profile.update');
});

Route::get('/lector-codigos-barras', 'BarcodeController@scan')->name('barcode.scan');
Route::group(['middleware' => ['role:Veterinario']], function () {
    Route::get('/inicio/veterinario', function () {
        return view('admin.home');
    })->name('veterinario');
});

Route::group(['middleware' => ['role:Peluquero']], function () {
    Route::get('/inicio/peluquero', function () {
        return view('admin.home');
    })->name('peluquero');
});
Route::get('/inicio/inventario', function () {
    return view('admin.home');
})->middleware('role:Inventario')->name('inventario');

Route::group(['middleware' => 'auth'], function () {
    Route::get('proveedores', [\App\Http\Controllers\ProveedoresController::class, 'index'])->name('proveedores.index')->middleware('can:ver proveedores');
    Route::get('proveedores/create', [\App\Http\Controllers\ProveedoresController::class, 'create'])->name('proveedores.create')->middleware('can:ingresar proveedores');
    Route::post('proveedores/delete', [\App\Http\Controllers\ProveedoresController::class, 'delete'])->name('proveedores.delete')->middleware('can:eliminar proveedores');
    Route::post('proveedores/store', [\App\Http\Controllers\ProveedoresController::class, 'store'])->name('proveedores.store')->middleware('can:ingresar proveedores');
    Route::get('proveedores/edit', [\App\Http\Controllers\ProveedoresController::class, 'edit'])->name('proveedores.edit')->middleware('can:modificar proveedores');
    Route::post('proveedores/update', [\App\Http\Controllers\ProveedoresController::class, 'update'])->name('proveedores.update')->middleware('can:modificar proveedores');
});

Route::group(['middleware' => ['can:acceso punto de venta']], function () {
    Route::get('inventario/punto_de_venta', [App\Http\Controllers\PointSaleController::class, 'index'])->name('point_sale.index');
    Route::post('inventario/punto_de_venta/venta', [App\Http\Controllers\PointSaleController::class, 'venta'])->name('point_sale.venta');
    Route::get('inventario/punto_de_venta/add', [App\Http\Controllers\PointSaleController::class, 'add_product'])->name('point_sale.addProduct');
    Route::get('inventario/punto_de_venta/update', [App\Http\Controllers\PointSaleController::class, 'update_product'])->name('point_sale.updateProduct');
    Route::get('inventario/punto_de_venta/clear', [App\Http\Controllers\PointSaleController::class, 'clear_products'])->name('point_sale.clear');
    Route::get('inventario/punto_de_venta/remove', [App\Http\Controllers\PointSaleController::class, 'remove_product'])->name('point_sale.removeProduct');
});
Route::group(['middleware' => ['can:acceso ventas']], function () {
    Route::get('inventario/detalle_venta', [App\Http\Controllers\PointSaleController::class, 'detalle_venta'])->name('ventas.detalle');
    Route::get('inventario/ventas', [App\Http\Controllers\PointSaleController::class, 'mostrar_ventas'])->name('ventas.index');
});
Route::get('/shop', [\App\Http\Controllers\CartController::class, 'shop'])->name('shop.shop');
Route::get('shop/cart', [\App\Http\Controllers\CartController::class, 'cart'])->name('shop.cart.index');
Route::post('/add', [\App\Http\Controllers\CartController::class, 'add'])->name('shop.cart.store');
Route::get('shop/show/{id}', [\App\Http\Controllers\CartController::class, 'show'])->name('shop.show');
Route::post('/update', [\App\Http\Controllers\CartController::class, 'update'])->name('shop.cart.update');
Route::post('/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('shop.cart.remove');
Route::post('/clear', [\App\Http\Controllers\CartController::class, 'clear'])->name('shop.cart.clear');

route::get('correo_test', function () {
    return view('emails.usuario_eliminado');
});

Auth::routes();
Route::get('/marca', [MarcasController::class, 'index'])->name('marcas');
Route::post('/marca', [MarcasController::class, 'store'])->name('marcas');

Route::get('/marca/{id}', [MarcasController::class, 'show'])->name('marcas-edit');
Route::patch('/marca/{id}', [MarcasController::class, 'update'])->name('marcas-update');
Route::delete('/marca/{id}', [MarcasController::class, 'destroy'])->name('marcas-destroy');




Route::middleware('auth')->group(function () {
    Route::get('/agendar-horas/create', [App\Http\Controllers\ReservarCitasController::class, 'create'])->name('agendar-horas.create');
    Route::post('/miscitas', [App\Http\Controllers\ReservarCitasController::class, 'store'])->name('Agendar');

    //JSON
    Route::get('/tiposervicios/{tiposervicio}/funcionarios', [App\Http\Controllers\Api\tiposerviciosController::class, 'funcionarios']);
});
