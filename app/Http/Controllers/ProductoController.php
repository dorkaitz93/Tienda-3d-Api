<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $porPagina = $request->query("por_pagina", 10);
        // Cargamos la relación categoria para que el JSON sea completo
        return response()->json(Producto::with('categoria')->paginate($porPagina));
    }

    public function store(Request $request)
    {
        try {
            $datosValidados = $request->validate([
                'categoria_id' => 'required|exists:categorias,id', // Validamos que la categoría exista
                'nombre'       => 'required|string|max:255',
                'enlace'       => 'required|string|unique:productos,enlace',
                'descripcion'  => 'required|string',
                'precio'       => 'required|numeric|min:0',
                'stock'        => 'required|integer|min:0',
                'imagen_url'   => 'nullable|string',
                'talla'        => 'nullable|string|max:50',
                'material'     => 'nullable|string|max:100',
                'dimensiones'  => 'nullable|string|max:100' // Cambiado tamano por dimensiones (como en tu migración)
            ]);

            $producto = Producto::create($datosValidados);
            return response()->json($producto, Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return response()->json(["errores" => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function show($id)
    {
        // Buscamos con la categoría incluida
        $producto = Producto::with('categoria')->find($id);

        if (!$producto) {
            return response()->json(['mensaje' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        if (!$producto) return response()->json(['mensaje' => 'No encontrado'], 404);

        try {
            $datosValidados = $request->validate([
                'categoria_id' => 'sometimes|exists:categorias,id',
                'nombre'       => 'sometimes|string|max:255',
                'enlace'       => 'sometimes|string|unique:productos,enlace,' . $producto->id,
                'precio'       => 'sometimes|numeric|min:0',
                'stock'        => 'sometimes|integer|min:0',
                'talla'        => 'nullable|string',
                'material'     => 'nullable|string',
                'dimensiones'  => 'nullable|string'
            ]);

            $producto->update($datosValidados);
            return response()->json(["mensaje" => "Producto actualizado", "producto" => $producto]);

        } catch (ValidationException $e) {
            return response()->json(["errores" => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        if (!$producto) return response()->json(['mensaje' => 'No encontrado'], 404);

        $producto->delete();
        return response()->json(["mensaje" => "Producto Eliminado"]);
    }
}