<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// --- RUTAS PÚBLICAS ---
Route::post("/login", [AuthController::class, 'login']);
Route::get("/estado", fn() => response()->json(["mensaje" => "OK"]));

// Ver productos y categorías es público (para que los clientes compren)
Route::get("productos", [ProductoController::class, 'index']);
Route::get("productos/{id}", [ProductoController::class, 'show']);
Route::get("categorias", [CategoriaController::class, 'index']);

// Los pedidos suelen ser públicos porque un "invitado" debe poder comprar
Route::post("pedidos", [PedidoController::class, 'store']);


// --- RUTAS PROTEGIDAS ---
Route::middleware('auth:sanctum')->group(function () {
    
    // Solo el admin puede crear, editar o borrar productos
    Route::post("productos", [ProductoController::class, 'store']);
    Route::put("productos/{id}", [ProductoController::class, 'update']);
    Route::delete("productos/{id}", [ProductoController::class, 'destroy']);

    Route::get('pedidos', [PedidoController::class, 'index']);
    
    // Ruta para cerrar sesión
    Route::post("/logout", [AuthController::class, 'logout']);
});