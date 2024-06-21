<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'home']);
Route::get('/productos/{id_categoria}', [HomeController::class, 'getProductosByCategoria']);
Route::get('/mi_carrito/pdf', [HomeController::class, 'pdf'])
    ->middleware(['auth', 'verified'])
    ->name('carrito.pdf');




Route::get('/dashboard', [HomeController::class,'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mis_ordenes', [HomeController::class,'mis_ordenes'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard',[HomeController::class, 'index'])->middleware(['auth', 'admin']);

Route::get('view_categoria',[AdminController::class, 'view_categoria'])->middleware(['auth', 'admin']);

Route::post('agregar_categoria',[AdminController::class, 'agregar_categoria'])->middleware(['auth', 'admin']);

Route::get('eliminar_categoria/{id}',[AdminController::class, 'eliminar_categoria'])->middleware(['auth', 'admin']);

Route::get('editar_categoria/{id}',[AdminController::class, 'editar_categoria'])->middleware(['auth', 'admin']);
Route::post('actualizar_categoria/{id}',[AdminController::class, 'actualizar_categoria'])->middleware(['auth', 'admin']);

Route::get('agregar_producto',[AdminController::class, 'agregar_producto'])->middleware(['auth', 'admin']);

Route::post('subir_producto',[AdminController::class, 'subir_producto'])->middleware(['auth', 'admin']);

Route::get('view_producto',[AdminController::class, 'view_producto'])->middleware(['auth', 'admin']);

Route::get('eliminar_producto/{id}',[AdminController::class, 'eliminar_producto'])->middleware(['auth', 'admin']);

Route::get('editar_producto/{id}',[AdminController::class, 'editar_producto'])->middleware(['auth', 'admin']);
Route::post('actualizar_producto/{id}',[AdminController::class, 'actualizar_producto'])->middleware(['auth', 'admin']);

//Route::get('buscar_producto',[AdminController::class, 'buscar_producto'])->middleware(['auth', 'admin']);
Route::get('buscar_orden',[AdminController::class, 'buscar_orden'])->middleware(['auth', 'admin']);

Route::get('detalles_producto/{id}',[HomeController::class, 'detalles_producto']);

Route::post('anadir_carrito/{id}', [HomeController::class, 'anadir_carrito'])->middleware(['auth', 'verified']);

Route::get('mi_carrito',[HomeController::class, 'mi_carrito'])->middleware(['auth', 'verified']);

Route::get('eliminar_prod_del_carrito/{id}',[HomeController::class, 'eliminar_prod_del_carrito'])->middleware(['auth', 'verified']);
Route::put('actualizar_cantidad/{id}',[HomeController::class, 'actualizar_cantidad'])->middleware(['auth', 'verified'])->name('actualizar_cantidad');

Route::post('confirmar_orden',[HomeController::class, 'confirmar_orden'])->middleware(['auth', 'verified']);

Route::get('view_ordenes',[AdminController::class, 'view_ordenes'])->middleware(['auth', 'admin']);

Route::get('en_camino/{id}',[AdminController::class, 'en_camino'])->middleware(['auth', 'admin']);

Route::get('entregado/{id}',[AdminController::class, 'entregado'])->middleware(['auth', 'admin']);


