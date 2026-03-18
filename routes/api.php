<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController; // Importante
use App\Http\Controllers\PedidoController;    // Importante
use Illuminate\Support\Facades\Route;

// Ruta de comprobación
Route::get("/estado", function(){
    return response()->json([
        "mensaje" => "El Backend de la tienda funciona correctamente",
        "estado" => "OK"
    ]);
});

// --- RUTAS DE LA TIENDA ---

// 1. Productos (Ya la tenías, ¡perfecta!)
Route::apiResource("productos", ProductoController::class);

// 2. Categorías (Para que Vue pinte el menú desplegable)
Route::get("categorias", [CategoriaController::class, 'index']);
Route::get("categorias/{categoria:slug}", [CategoriaController::class, 'show']);

// 3. Pedidos (Para procesar la compra del carrito)
Route::post("pedidos", [PedidoController::class, 'store']);