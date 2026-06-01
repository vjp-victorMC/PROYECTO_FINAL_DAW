<?php
// =====================================
// API DE TALLER MECÁNICO - RUTAS REST
// =====================================
// Este archivo define todas las rutas de la API, agrupadas y comentadas por lógica de negocio.

use App\Http\Controllers\CocheController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Coche2manoController;
use App\Http\Controllers\ContabilidadController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\PiezaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReparacionController;
use App\Http\Controllers\ReparacionPiezaController;

// =============================
// 1. USUARIOS Y AUTENTICACIÓN
// =============================
    Route::get('/usuario', [UsuarioController::class, 'getAllUser']);
    Route::post('/usuario/login', [UsuarioController::class, 'login']);
    Route::post('/usuario/logout', [UsuarioController::class, 'logout']);
    Route::post('/usuario/newUser', [UsuarioController::class, 'setNewUser']);
    Route::get('/usuario/getId/{dni}', [UsuarioController::class, 'getIdByDni']);
    Route::get('/usuario/cars/{id}', [CocheController::class, 'getUsuarioCars']);
    Route::get('/usuario/{id}', [UsuarioController::class, 'getUserByID']);
    Route::post('/usuarios', [UsuarioController::class, 'store']);
    Route::put('/usuarios/{id_usuario}', [UsuarioController::class, 'update']);
    Route::delete('/usuarios/{id_usuario}', [UsuarioController::class, 'destroy']);
    Route::get('/usuarios/metricas/roles', [UsuarioController::class, 'getMetricasRoles']);
    Route::get('/mecanicos', [UsuarioController::class, 'getMecanicos']);


// =============================
// 2. COCHES Y COCHES DE 2ª MANO
// =============================
    Route::post('/usuario/newCar', [CocheController::class, 'setNewCar']);
    Route::post('/usuario/mensaje', [MensajeController::class, 'mensajesCliente']);
    Route::get('/coches/{id_coche}/detalle', [CocheController::class, 'getDetalleVehiculo']);
    Route::get('/coches/matricula/{matricula}', [CocheController::class, 'getIdPorMatricula']);
    Route::get('/coche2mano', [Coche2manoController::class, 'getAll2HandCar']);
    Route::get('/coche2mano/matricula/{matricula}', [Coche2manoController::class, 'getIdPorMatricula']);
    Route::post('/contabilidad/transaccion', [ContabilidadController::class, 'store']);
    Route::get('/contabilidad/estado', [ContabilidadController::class, 'getEstadoFinanciero']);
    Route::post('/coche2mano/newCoche2mano', [Coche2ManoController::class, 'storeCoche2Mano']);
    Route::delete('/coches-segunda-mano/{id}/retirar', [Coche2ManoController::class, 'retirarDelTaller']);
    Route::post('/coches-segunda-mano/{id}/vender', [Coche2ManoController::class, 'venderCoche']);

// =============================
// 3. MENSAJES
// =============================
    Route::get('/admin/mensajes/recibidos/{id_recibo}', [MensajeController::class, 'obtenerMensajesRecibidos']);
    Route::delete('/admin/mensaje/{id_mensaje}', [MensajeController::class, 'eliminarMensaje']);

// =============================
// 4. ADMINISTRACIÓN Y REPARACIONES
// =============================
    Route::post('/reparacion/asignar-mecanico', [ReparacionController::class, 'asignarMecanico']);
    Route::post('/reparacion/cobrar', [ReparacionController::class, 'cobrarReparacion']);
    Route::get('/reparacion/estado', [ReparacionController::class, 'getEstadoReparacion']);
    Route::get('/admin/coches/para-pagar', [CocheController::class, 'getCochesParaPagar']);
    Route::get('/reparaciones/conteo-estados', [ReparacionController::class, 'getReparacionesCountPorEstado']); //Victor
    Route::get('/admin/reparaciones/en-proceso/count', [ReparacionController::class, 'getReparacionesEnProcesoCount']);
    Route::get('/admin/coches/garaje', [CocheController::class, 'getCochesEnGaraje']);
    Route::post('/admin/reparaciones', [ReparacionController::class, 'setNewReparacion']);
    Route::post('/reparaciones/add-pieza', [ReparacionPiezaController::class, 'addPiezaAReparacion']); //Victor
    Route::put('/reparaciones/cambiar-estado', [ReparacionController::class, 'cambiarEstado']);  //Victor
    Route::get('/reparaciones/mecanico/{id_mecanico}', [ReparacionController::class, 'getReparacionesPorMecanico']); //Victor
    Route::get('/reparaciones/{id_reparacion}/piezas', [ReparacionController::class, 'getPiezasPorReparacion']);  //Victor

// =============================
// 5. CONTABILIDAD Y DASHBOARD
// =============================
    Route::post('/contabilidad/transaccion', [ContabilidadController::class, 'store']);
    Route::get('/contabilidad/estado', [ContabilidadController::class, 'getEstadoFinanciero']);
    Route::get('/dashboard/metricas', [ContabilidadController::class, 'getDashboardData']);

// =============================
// 6. INVENTARIO Y PROVEEDORES
// =============================
    Route::post('/piezas', [PiezaController::class, 'store']);
    Route::get('/piezas', [PiezaController::class, 'index']);
    Route::post('/piezas/{id_pieza}/comprar', [PiezaController::class, 'comprarPieza']);
    Route::get('/piezas/bajo-minimo', [PiezaController::class, 'getBajoStockMinimo']);
    Route::get('/piezas/sin-stock/total', [PiezaController::class, 'getCountSinStock']);
    Route::post('/proveedores', [ProveedorController::class, 'store']);
    Route::get('/proveedores', [ProveedorController::class, 'index']);
    Route::get('/proveedores/{id_proveedor}', [ProveedorController::class, 'show']);
    Route::put('/proveedores/{id_proveedor}', [ProveedorController::class, 'update']);
    Route::delete('/proveedores/{id_proveedor}', [ProveedorController::class, 'destroy']);
    Route::get('/piezas', [PiezaController::class, 'getTodasLasPiezas']);  //Victor
    Route::get('/proveedores/{id_proveedor}/piezas', [ProveedorController::class, 'getPiezasByProveedor']);

// =============================
// 7. RUTAS PRIVADAS (AUTENTICADAS)
// =============================
// Todas las rutas son públicas para desarrollo y pruebas, sin middleware.
    Route::get('/image/proxy', [\App\Http\Controllers\ImageProxyController::class, 'proxy']);
