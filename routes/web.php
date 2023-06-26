<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\InsumosMedicosController;
use App\Http\Controllers\MarcaproductoController;
use App\Http\Controllers\ProductosVentaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ComprobanteController;
use app\Http\Controllers\CartController;
use App\Mail\ConfirmacionHora;
use Illuminate\Support\Facades\Mail;
use app\Http\Controllers\CompraController;

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

Route::get('/', [\App\Http\Controllers\LandingPageController::class, 'index_landingpage'])->name('inicio');

Route::get('/nosotros', [\App\Http\Controllers\LandingPageController::class, 'aboutUs'])->name('nosotros');
Route::get('/servicios', function () {
    return view('servicios');
})->name('servicios');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','can:ver productos']], function () {
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
    Route::get('tipoproductos_ventas/create', [\App\Http\Controllers\tipoproductos_ventasController::class, 'create'])->name('admin.tipoproductos_ventas.create')->middleware(['permission:ingresar productos']);
    Route::post('tipoproductos_ventas/store', [\App\Http\Controllers\tipoproductos_ventasController::class, 'store'])->name('admin.tipoproductos_ventas.store')->middleware(['permission:ingresar productos']);
    Route::get('tipoproductos_ventas/edit', [\App\Http\Controllers\tipoproductos_ventasController::class, 'edit'])->name('admin.tipoproductos_ventas.edit')->middleware(['permission:modificar productos']);
    Route::post('tipoproductos_ventas/delete', [\App\Http\Controllers\tipoproductos_ventasController::class, 'delete'])->name('admin.tipoproductos_ventas.delete')->middleware(['permission:eliminar productos']);
    Route::post('tipoproductos_ventas/update', [\App\Http\Controllers\tipoproductos_ventasController::class, 'update'])->name('admin.tipoproductos_ventas.update')->middleware(['permission:modificar productos']);
});

Route::group(['middleware' => ['auth','can:ver insumos medicos']], function () {
    Route::get('insumos_medicos', [App\Http\Controllers\InsumosMedicosController::class, 'index_insumos'])->name('admin.insumos_medicos.index')->middleware(['permission:ver insumos medicos']);
    Route::get('insumos_medicos/create', [App\Http\Controllers\InsumosMedicosController::class, 'create'])->name('admin.insumos_medicos.create')->middleware(['permission:ingresar insumos medicos']);
    Route::get('insumos_medicos/edit/{id}', [App\Http\Controllers\InsumosMedicosController::class, 'edit'])->name('admin.insumos_medicos.edit')->middleware(['permission:modificar insumos medicos']);
    Route::post('insumos_medicos/update', [App\Http\Controllers\InsumosMedicosController::class, 'update'])->name('admin.insumos_medicos.update')->middleware(['permission:modificar insumos medicos']);
    Route::post('insumos_medicos/store', [App\Http\Controllers\InsumosMedicosController::class, 'store'])->name('admin.insumos_medicos.store')->middleware(['permission:ingresar insumos medicos']);
    Route::post('insumos_medicos/delete', [App\Http\Controllers\InsumosMedicosController::class, 'delete'])->name(('admin.insumos_medicos.delete'))->middleware(['permission:eliminar insumos medicos']);
    // Route::get('insumosmedicos/tipoinsumos/{id}', [App\Http\Controllers\InsumosMedicosController::class, 'modify_roles'])->name('admin.usuarios.roles');

    Route::get('tipo_insumos', [\App\Http\Controllers\TipoinsumosController::class, 'index_tipo'])->name('admin.tipoinsumos.index')->middleware(['permission:ver insumos medicos']);
    Route::get('tipo_insumos/create', [\App\Http\Controllers\TipoinsumosController::class, 'create'])->name('admin.tipoinsumos.create')->middleware(['permission:ingresar insumos medicos']);
    Route::post('tipo_insumos/store', [\App\Http\Controllers\TipoinsumosController::class, 'store_tipo'])->name('admin.tipoinsumos.store')->middleware(['permission:ingresar insumos medicos']);
    Route::get('tipo_insumos/edit', [\App\Http\Controllers\TipoinsumosController::class, 'edit'])->name('admin.tipoinsumos.edit')->middleware(['permission:modificar insumos medicos']);
    Route::post('tipo_insumos/delete', [\App\Http\Controllers\TipoinsumosController::class, 'delete'])->name('admin.tipoinsumos.delete')->middleware(['permission:eliminar insumos medicos']);
    Route::post('tipo_insumos/update', [\App\Http\Controllers\TipoinsumosController::class, 'update'])->name('admin.tipoinsumos.update')->middleware(['permission:modificar insumos medicos']);

    Route::get('admin/marcaInsumos', [\App\Http\Controllers\MarcaInsumoController::class, 'index_marca'])->name('admin.marcaInsumos.index');
    Route::get('admin/marcaInsumos/create', [\App\Http\Controllers\MarcaInsumoController::class, 'create'])->name('admin.marcaInsumos.create')->middleware(['permission:ingresar insumos medicos']);
    Route::post('admin/marcaInsumos/delete', [\App\Http\Controllers\MarcaInsumoController::class, 'delete'])->name('admin.marcaInsumos.delete')->middleware(['permission:eliminar insumos medicos']);
    Route::post('admin/marcaInsumos/store', [\App\Http\Controllers\MarcaInsumoController::class, 'store'])->name('admin.marcaInsumos.store')->middleware(['permission:ingresar insumos medicos']);
    Route::get('admin/marcaInsumos/edit', [\App\Http\Controllers\MarcaInsumoController::class, 'edit'])->name('admin.marcaInsumos.edit')->middleware(['permission:modificar insumos medicos']);
    Route::post('admin/marcaInsumos/update', [\App\Http\Controllers\MarcaInsumoController::class, 'update'])->name('admin.marcaInsumos.update')->middleware(['permission:modificar insumos medicos']);
});

Route::group(['middleware' => 'auth','can:acceso punto de venta'], function () {
    Route::get('control-servicios', [App\Http\Controllers\ControlServicioController::class, 'index'])->name('control_servicios.index');
    Route::get('control-servicios/agendar', [App\Http\Controllers\ControlServicioController::class, 'createR'])->name('control_servicios.agendar');
    Route::post('control-servicios/reservar', [App\Http\Controllers\ControlServicioController::class, 'store'])->name('control_servicios.reservar');
    Route::post('control-servicios/pagar', [App\Http\Controllers\ControlServicioController::class, 'pagar_reserva'])->name('control_servicios.pagar');
});

Route::group(['middleware' => ['auth','can:acceso administracion de stock']], function () {
    Route::get('administracion-stock', [App\Http\Controllers\AdministracionInventario::class, 'index'])->name('administracion_inventario.index');
    Route::get('administracion-stock/historial', [App\Http\Controllers\AdministracionInventario::class, 'historial_admin'])->name('administracion_inventario.historial');
    Route::post('administracion-stock/realizar_admin', [App\Http\Controllers\AdministracionInventario::class, 'admin_item'])->name('administracion_inventario.realizar_admin');
    Route::get('administracion-stock/ver_item', [App\Http\Controllers\AdministracionInventario::class, 'ver_item'])->name('administracion_inventario.verItem');
    Route::get('administracion-stock/barcode_scan', [App\Http\Controllers\AdministracionInventario::class, 'ver_item_codigo'])->name('administracion_inventario.scan');
    Route::get('administracion-stock/descargar_factura', [App\Http\Controllers\AdministracionInventario::class, 'descargar_factura'])->name('administracion_inventario.descargarFactura');
});

Route::group(['middleware' => ['auth','can:ver medicamentos vacunas']], function () {
    Route::get('medicamentos_vacunas', [App\Http\Controllers\medicamentos_vacunasController::class, 'index_medicamentos_vacunas'])->name('admin.medicamentos_vacunas.index');
    Route::get('medicamentos_vacunas/create', [App\Http\Controllers\medicamentos_vacunasController::class, 'create'])->name('admin.medicamentos_vacunas.create')->middleware(['can:ingresar medicamentos vacunas']);
    Route::get('medicamentos_vacunas/edit/{id}', [App\Http\Controllers\medicamentos_vacunasController::class, 'edit'])->name('admin.medicamentos_vacunas.edit')->middleware(['can:modificar medicamentos vacunas']);
    Route::post('medicamentos_vacunas/update', [App\Http\Controllers\medicamentos_vacunasController::class, 'update'])->name('admin.medicamentos_vacunas.update')->middleware(['can:modificar medicamentos vacunas']);
    Route::post('medicamentos_vacunas/store', [App\Http\Controllers\medicamentos_vacunasController::class, 'store'])->name('admin.medicamentos_vacunas.store')->middleware(['can:ingresar medicamentos vacunas']);
    Route::post('medicamentos_vacunas/delete', [App\Http\Controllers\medicamentos_vacunasController::class, 'delete'])->name(('admin.medicamentos_vacunas.delete'))->middleware(['can:eliminar medicamentos vacunas']);

    Route::get('tipo_medicamentos_vacunas', [\App\Http\Controllers\tipomedicamentos_vacunasController::class, 'index_tipo'])->name('admin.tipomedicamentos_vacunas.index');
    Route::get('tipo_medicamentos_vacunas/create', [\App\Http\Controllers\tipomedicamentos_vacunasController::class, 'create'])->name('admin.tipomedicamentos_vacunas.create')->middleware(['can:ingresar medicamentos vacunas']);
    Route::post('tipo_medicamentos_vacunas/store', [\App\Http\Controllers\tipomedicamentos_vacunasController::class, 'store_tipo'])->name('admin.tipomedicamentos_vacunas.store')->middleware(['can:ingresar medicamentos vacunas']);
    Route::get('tipo_medicamentos_vacunas/edit', [\App\Http\Controllers\tipomedicamentos_vacunasController::class, 'edit'])->name('admin.tipomedicamentos_vacunas.edit')->middleware(['can:modificar medicamentos vacunas']);
    Route::post('tipo_medicamentos_vacunas/delete', [\App\Http\Controllers\tipomedicamentos_vacunasController::class, 'delete'])->name('admin.tipomedicamentos_vacunas.delete')->middleware(['can:eliminar medicamentos vacunas']);
    Route::post('tipo_medicamentos_vacunas/update', [\App\Http\Controllers\tipomedicamentos_vacunasController::class, 'update'])->name('admin.tipomedicamentos_vacunas.update')->middleware(['can:modificar medicamentos vacunas']);

    Route::get('admin/marcamedicamentos_vacunas', [\App\Http\Controllers\MarcaMedicamentoController::class, 'index_marca'])->name('admin.marcamedicamentos_vacunas.index')->middleware(['can:ver medicamentos vacunas']);
    Route::get('admin/marcamedicamentos_vacunas/create', [\App\Http\Controllers\MarcaMedicamentoController::class, 'create'])->name('admin.marcamedicamentos_vacunas.create')->middleware(['can:ingresar medicamentos vacunas']);
    Route::post('admin/marcamedicamentos_vacunas/delete', [\App\Http\Controllers\MarcaMedicamentoController::class, 'delete'])->name('admin.marcamedicamentos_vacunas.delete')->middleware(['can:eliminar medicamentos vacunas']);
    Route::post('admin/marcamedicamentos_vacunas/store', [\App\Http\Controllers\MarcaMedicamentoController::class, 'store'])->name('admin.marcamedicamentos_vacunas.store')->middleware(['can:ingresar medicamentos vacunas']);
    Route::get('admin/marcamedicamentos_vacunas/edit', [\App\Http\Controllers\MarcaMedicamentoController::class, 'edit'])->name('admin.marcamedicamentos_vacunas.edit')->middleware(['can:modificar medicamentos vacunas']);
    Route::post('admin/marcamedicamentos_vacunas/update', [\App\Http\Controllers\MarcaMedicamentoController::class, 'update'])->name('admin.marcamedicamentos_vacunas.update')->middleware(['can:modificar medicamentos vacunas']);
});

Route::group(['middleware' => ['auth','can:ver especies']], function () {
    Route::get('especies', [App\Http\Controllers\EspecieController::class, 'index'])->name('admin.especies.index');
    Route::get('especies/create', [App\Http\Controllers\EspecieController::class, 'create'])->name('admin.especies.create')->middleware(['can:ingresar especies']);
    Route::get('especies/edit/{id}', [App\Http\Controllers\EspecieController::class, 'edit'])->name('admin.especies.edit')->middleware(['can:modificar especies']);
    Route::post('especies/update', [App\Http\Controllers\EspecieController::class, 'update'])->name('admin.especies.update')->middleware(['can:modificar especies']);
    Route::post('especies/store', [App\Http\Controllers\EspecieController::class, 'store'])->name('admin.especies.store')->middleware(['can:ingresar especies']);
    Route::post('especies/delete', [App\Http\Controllers\EspecieController::class, 'delete'])->name(('admin.especies.delete'))->middleware(['can:eliminar especies']);
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('notification/getUpdate', [App\Http\Controllers\UserController::class, 'get_notifications_count'])->name('users.notification.updateNotificationCount');
    Route::get('notification', [App\Http\Controllers\UserController::class, 'get_notifications'])->name('users.notification.index');
    Route::post('notification/delete', [App\Http\Controllers\UserController::class, 'delete_notification'])->name('users.notification.delete');

    Route::get('perfil', [App\Http\Controllers\UserController::class, 'user_profile'])->name('user.profile.index');
    Route::get('perfil/edit', [App\Http\Controllers\UserController::class, 'modify_user_profile'])->name('user.profile.modify');
    Route::post('perfil/update', [App\Http\Controllers\UserController::class, 'update_user_profile'])->name('user.profile.update');
});

Route::group(['middleware' => ['auth','can:ver servicios']], function () {

    Route::get('servicio', [\App\Http\Controllers\ServicioController::class, 'index'])->name('admin.servicio');
    Route::get('servicio/create', [\App\Http\Controllers\ServicioController::class, 'create'])->name('admin.servicio.create')->middleware(['can:ingresar servicios']);
    Route::post('servicio/store', [\App\Http\Controllers\ServicioController::class, 'store'])->name('admin.servicio.store')->middleware(['can:ingresar servicios']);
    Route::get('servicio/edit', [\App\Http\Controllers\ServicioController::class, 'edit'])->name('admin.servicio.edit')->middleware(['can:modificar servicios']);
    Route::post('servicio/delete', [\App\Http\Controllers\ServicioController::class, 'delete'])->name('admin.servicio.delete')->middleware(['can:eliminar servicios']);
    Route::post('servicio/update', [\App\Http\Controllers\ServicioController::class, 'update'])->name('admin.servicio.update')->middleware(['can:modificar servicios']);

    Route::get('tiposervicios', [\App\Http\Controllers\tiposerviciosController::class, 'index'])->name('admin.tiposervicios.index')->middleware(['can:ver servicios']);
    Route::get('tiposervicios/create', [\App\Http\Controllers\tiposerviciosController::class, 'create'])->name('admin.tiposervicios.create')->middleware(['can:ingresar servicios']);
    Route::post('tiposervicios/store', [\App\Http\Controllers\tiposerviciosController::class, 'store'])->name('admin.tiposervicios.store')->middleware(['can:ingresar servicios']);
    Route::get('tiposervicios/edit', [\App\Http\Controllers\tiposerviciosController::class, 'edit'])->name('admin.tiposervicios.edit')->middleware(['can:modificar servicios']);
    Route::post('tiposervicios/delete', [\App\Http\Controllers\tiposerviciosController::class, 'delete'])->name('admin.tiposervicios.delete')->middleware(['can:eliminar servicios']);
    Route::post('tiposervicios/update', [\App\Http\Controllers\tiposerviciosController::class, 'update'])->name('admin.tiposervicios.update')->middleware(['can:modificar servicios']);

    Route::get('tipoconsulta_tamanio', [\App\Http\Controllers\tipo_consulta_tamanioController::class, 'index'])->name('admin.tipoconsulta_tamanio.index');
   
});
Route::group(['middleware' => ['auth','can:ver usuario']], function () {
    Route::get('usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('admin.usuarios.index')->middleware(['can:ver usuario']);
    Route::post('usuarios/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('admin.usuarios.delete')->middleware(['can:eliminar usuario']);
    Route::get('usuarios/roles/{id}', [App\Http\Controllers\UserController::class, 'modify_roles'])->name('admin.usuarios.roles')->middleware(['can:asignar roles usuario']);
    Route::get('usuarios/add', [App\Http\Controllers\UserController::class, 'add_user'])->name('admin.usuarios.add')->middleware(['can:ingresar usuario']);
    Route::post('usuarios/store', [App\Http\Controllers\UserController::class, 'store_user'])->name('admin.usuarios.store')->middleware(['can:ingresar usuario']);
    Route::post('usuarios/roles/update', [App\Http\Controllers\UserController::class, 'update_roles'])->name('admin.usuarios.update.roles')->middleware(['can:asignar roles usuario']);
});
Route::group(['middleware' => ['auth','can:ver roles']], function () {
    Route::get('roles', [App\Http\Controllers\UserController::class, 'index_roles'])->name('admin.roles.index')->middleware(['can:ver roles']);
    Route::get('roles/add', [App\Http\Controllers\UserController::class, 'add_rol'])->name('admin.roles.add')->middleware(['can:ingresar roles']);
    Route::post('roles/store', [App\Http\Controllers\UserController::class, 'store_rol'])->name('admin.roles.store')->middleware(['can:ingresar roles']);
    Route::get('roles/modify/{id}', [App\Http\Controllers\UserController::class, 'modify_rol'])->name('admin.roles.modify')->middleware(['can:modificar roles']);
    Route::post('roles/update', [App\Http\Controllers\UserController::class, 'update_rol'])->name('admin.roles.update')->middleware(['can:modificar roles']);
    Route::post('roles/delete', [App\Http\Controllers\UserController::class, 'delete_rol'])->name('admin.roles.delete')->middleware(['can:eliminar roles']);
});
Route::group(['middleware' => ['auth','can:modificar landing page']], function () {
    Route::get('/landing/ubication/edit', [\App\Http\Controllers\LandingPageController::class, 'modify_landingpage_ubication'])->name('landing.ubication.edit');
    Route::post('/landing/ubication/update', [\App\Http\Controllers\LandingPageController::class, 'update_landingpage_ubication'])->name('landing.ubication.update');
    Route::get('/landing/nosotros/edit', [\App\Http\Controllers\LandingPageController::class, 'modify_aboutus'])->name('landing.nosotros.edit');
    Route::post('/landing/nosotros/update', [\App\Http\Controllers\LandingPageController::class, 'update_aboutus'])->name('landing.nosotros.update');
    Route::post('/landing/update', [\App\Http\Controllers\LandingPageController::class, 'update_landingpage'])->name('landing.update');
    Route::post('/landing/gallery/add', [\App\Http\Controllers\LandingPageController::class, 'add_photo_gallery'])->name('landing.gallery.add');
    Route::post('/landing/website/update', [\App\Http\Controllers\LandingPageController::class, 'update_website'])->name('landing.website.update');
    Route::get('/landing/website/edit',[\App\Http\Controllers\LandingPageController::class, 'modify_website'])->name('landing.website.edit');
    Route::get('/landing/galeria/delete', [\App\Http\Controllers\LandingPageController::class, 'delete_photo_gallery'])->name('landing.gallery.delete');
    Route::get('/landing/horario/edit', [\App\Http\Controllers\LandingPageController::class, 'modify_horario_landingpage'])->name('landing.horario.edit');
    Route::post('/landing/horario/update', [\App\Http\Controllers\LandingPageController::class, 'update_horario_landingpage'])->name('landing.horario.update');
});
Route::group(['middleware' => ['auth','role:Admin']], function () {

    Route::get('/inicio/administrador', [\App\Http\Controllers\HorarioController::class, 'index'])->name('admin');

    Route::get('horario', [App\Http\Controllers\HorariosController::class, 'index'])->name('admin.horario.index');
    Route::post('horario/store', [App\Http\Controllers\HorariosController::class, 'store'])->name('admin.horario.store');
    Route::get('admin/horario/add', [App\Http\Controllers\HorariosController::class, 'add'])->name('admin.horario.add');
    Route::get('admin/horario/show', [App\Http\Controllers\HorariosController::class, 'show']);
    Route::post('admin/horario/edit/{id}', [App\Http\Controllers\HorariosController::class, 'edit']);
    Route::post('admin/horario/delete/{id}', [App\Http\Controllers\HorariosController::class, 'delete']);
    Route::post('admin/horario/actualizar/{horarios}', [App\Http\Controllers\HorariosController::class, 'update']);
    //Rutas funcionarios
    Route::resource('/funcionarios', 'App\Http\Controllers\FuncionariosController');

    Route::post('/a', 'ComprobanteController@generarComprobante');
    Route::get('/generar-comprobante', [\App\Http\Controllers\ComprobanteController::class, 'generarComprobante'] )->name('generar-comprobante');
});
Route::group(['middleware' => ['role:Veterinario|Peluquero']], function () {
    Route::get('horariofuncionarios',[App\Http\Controllers\HorarioFuncionariosController::class, 'edit'])->name('admin.horariofuncionarios.edit');
    Route::post('horariofuncionarios/store',[App\Http\Controllers\HorarioFuncionariosController::class, 'store'])->name('admin.horariofuncionarios.store');
    //Rutas pacientes
    Route::resource('/pacientes','App\Http\Controllers\PacientesController');
    
});
Route::get('/trazabilidad-ventas-y-servicios', [\App\Http\Controllers\TrazabilidadController::class, 'generarTrazabilidadVentasYServicios'] )->name('trazabilidad-ventas-y-servicios')->middleware('role_or_permission:acceso ventas|acceso punto de venta|acceso administracion de stock|Admin');
Route::get('/dashboard-citas', [\App\Http\Controllers\TrazabilidadController::class, 'generarDashboardCitas'] )->name('dashboard-citas')->middleware('role_or_permission:ver gestionvet|ver gestionpeluqueria|ver citas|Admin');
Route::get('/lector-codigos-barras', [\App\Http\Controllers\BarcodeController::class, 'scan'])->name('barcode.scan');
Route::group(['middleware' => ['role:Veterinario']], function () {
    Route::get('/inicio/veterinario', function () {
        return view('admin.home');
    })->name('veterinario');
});
Route::get('/inicio', [\App\Http\Controllers\HorarioController::class, 'index'])->name('inicio_panel');

Route::group(['middleware' => ['role:Peluquero']], function () {
    Route::get('/inicio/peluquero', function () {
        return view('admin.home');
    })->name('peluquero');
});
Route::get('/inicio/inventario', function () {
    return view('admin.home');
})->middleware('role:Inventario')->name('inventario');

Route::group(['middleware' => 'auth','can:ver proveedores'], function () {
    Route::get('proveedores', [\App\Http\Controllers\ProveedoresController::class, 'index'])->name('proveedores.index')->middleware('can:ver proveedores');
    Route::get('proveedores/create', [\App\Http\Controllers\ProveedoresController::class, 'create'])->name('proveedores.create')->middleware('can:ingresar proveedores');
    Route::post('proveedores/delete', [\App\Http\Controllers\ProveedoresController::class, 'destroy'])->name('proveedores.delete')->middleware('can:eliminar proveedores');
    Route::post('proveedores/store', [\App\Http\Controllers\ProveedoresController::class, 'store'])->name('proveedores.store')->middleware('can:ingresar proveedores');
    Route::get('proveedores/edit/{id}', [\App\Http\Controllers\ProveedoresController::class, 'edit'])->name('proveedores.edit')->middleware('can:modificar proveedores');
    Route::post('proveedores/update', [\App\Http\Controllers\ProveedoresController::class, 'update'])->name('proveedores.update')->middleware('can:modificar proveedores');
});

Route::group(['middleware' => ['auth','can:acceso punto de venta']], function () {
    Route::get('inventario/punto_de_venta', [App\Http\Controllers\PointSaleController::class, 'index'])->name('point_sale.index');
    Route::post('inventario/punto_de_venta/venta', [App\Http\Controllers\PointSaleController::class, 'venta'])->name('point_sale.venta');
    Route::get('inventario/punto_de_venta/add', [App\Http\Controllers\PointSaleController::class, 'add_product'])->name('point_sale.addProduct');
    Route::get('inventario/punto_de_venta/update', [App\Http\Controllers\PointSaleController::class, 'update_product'])->name('point_sale.updateProduct');
    Route::get('inventario/punto_de_venta/clear', [App\Http\Controllers\PointSaleController::class, 'clear_products'])->name('point_sale.clear');
    Route::get('inventario/punto_de_venta/remove', [App\Http\Controllers\PointSaleController::class, 'remove_product'])->name('point_sale.removeProduct');
});
Route::group(['middleware' => ['auth','can:acceso ventas']], function () {
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




Route::any('shop/resumen-compra', [\App\Http\Controllers\CompraController::class, 'resumen_compra'])->name('shop.resumen-compra')->middleware(['role:Cliente|Invitado']);  
Route::any('shop/checkout',[\App\Http\Controllers\CompraController::class, 'index'])->name('shop.checkout.checkout')->middleware(['role:Cliente|Invitado']);
Route::get('shop/checkout/login',[\App\Http\Controllers\CompraController::class, 'login'])->name('shop.checkout.login');
Route::post('shop/checkout/login',[\App\Http\Controllers\CompraController::class, 'login_shop'])->name('login_shop');
Route::get('shop/checkout/registro_invitado',[\App\Http\Controllers\CompraController::class, 'registro_invitado'])->name('shop.checkout.registro_invitado');
Route::post('shop/checkout/registro_invitado',[\App\Http\Controllers\CompraController::class, 'registro_invitado_shop'])->name('register_invitado');

Route::get('shop/finish/{status_finish}',[\App\Http\Controllers\CompraController::class, 'finish'])->name('finish');
Route::post('/webpayplus',[\App\Http\Controllers\TransbankController::class, 'checkout'])->name('webpayplus');


// Route::post('/webpayplus',[\App\Http\Controllers\TransbankController::class,'checkout']);


route::get('correo_test', function () {
    return view('emails.usuario_eliminado');
});

Auth::routes();

Route::get('/agendar-horas/create',[App\Http\Controllers\ReservarCitasController::class, 'create'])->name('agendar-horas.create');
Route::post('/agendar-horas',[App\Http\Controllers\ReservarCitasController::class, 'store'])->middleware('auth');
//JSON
    Route::get('/obtener-usuarios/{tiposervicio_id}/funcionarios', [App\Http\Controllers\Api\tiposerviciosController::class, 'obtenerUsuarios']);
    Route::get('/horariofuncionarios/horas', [App\Http\Controllers\Api\HorarioController::class, 'hours']);
Route::middleware('auth')->group(function(){
    Route::get('/miscitas',[App\Http\Controllers\ReservarCitasController::class, 'index'])->name('Agendar');
    Route::get('/miscitas/{ReservarCita}',[App\Http\Controllers\ReservarCitasController::class, 'show']);
    Route::post('/miscitas/{ReservarCita}/cancel',[App\Http\Controllers\ReservarCitasController::class, 'cancel']);
    Route::get('/miscitas/{ReservarCita}/cancel',[App\Http\Controllers\ReservarCitasController::class, 'formCancel']);
    Route::post('/miscitas/{ReservarCita}/confirm',[App\Http\Controllers\ReservarCitasController::class, 'confirm']);

    
});

Route ::get('horas', function(){
    return view('emails.confirm_horas');
});
