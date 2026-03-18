<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index()
    {
        
        return response()->json(Pedido::with('productos')->get()); // para traer todos los productos
    }
    public function store(Request $request)
    {
        // 1. Validamos los datos que vienen de Vue
        $request->validate([
            'cliente_nombre' => 'required|string',
            'cliente_email'  => 'required|email',
            'direccion'      => 'required|string',
            'carrito'        => 'required|array', // Lista de productos
        ]);

        // Usamos una Transacción: O se guarda TODO o no se guarda NADA (seguridad)
        return DB::transaction(function () use ($request) {
            
            // 2. Crear la cabecera del pedido
            $pedido = Pedido::create([
                'user_id'        => auth()->id(), // Si está logueado, pilla su ID. Si no, null.
                'cliente_nombre' => $request->cliente_nombre,
                'cliente_email'  => $request->cliente_email,
                'direccion'      => $request->direccion,
                'total'          => 0, // Lo calcularemos ahora
                'estado'         => 'pendiente',
            ]);

            $totalPedido = 0;

            // 3. Recorrer el carrito y llenar la tabla pivote
            foreach ($request->carrito as $item) {
                $producto = Producto::find($item['id']);
                
                if ($producto) {
                    $subtotal = $producto->precio * $item['cantidad'];
                    $totalPedido += $subtotal;

                    // Conectamos el pedido con el producto en la tabla pedido_producto
                    $pedido->productos()->attach($producto->id, [
                        'cantidad' => $item['cantidad'],
                        'precio_unitario' => $producto->precio
                    ]);

                    // OPCIONAL: Restar el stock si quieres ser pro
                    $producto->decrement('stock', $item['cantidad']);
                }
            }

            // 4. Actualizamos el total real del pedido
            $pedido->update(['total' => $totalPedido]);

            return response()->json([
                'msg' => 'Pedido realizado con éxito',
                'pedido_id' => $pedido->id
            ], 201);
        });
    }
}