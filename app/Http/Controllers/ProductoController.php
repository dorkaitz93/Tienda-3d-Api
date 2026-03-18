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
        return response()->json(Producto::paginate($porPagina));
    }

    public function store(Request $request)
    {
        try {
            $datosValidados = $request->validate([
                'nombre'      => 'required|string|max:255',
                'enlace'      => 'required|string|unique:productos,enlace',
                'descripcion' => 'required|string',
                'precio'      => 'required|numeric|min:0',
                'stock'       => 'required|integer|min:0',
                'imagen_url'  => 'nullable|string',
                // Nuevos campos validados
                'tipo'        => 'required|in:camiseta,figura',
                'talla'       => 'nullable|string|max:50',
                'material'    => 'nullable|string|max:100',
                'tamano'      => 'nullable|string|max:100'
            ]);

            $producto = Producto::create($datosValidados);
            return response()->json($producto, Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return response()->json(["errores" => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function show(Producto $producto)
    {
        return response()->json($producto);
    }

    public function update(Request $request, Producto $producto)
    {
        try {
            $datosValidados = $request->validate([
                'nombre'      => 'sometimes|string|max:255',
                'enlace'      => 'sometimes|string|unique:productos,enlace,' . $producto->id,
                'precio'      => 'sometimes|numeric|min:0',
                'stock'       => 'sometimes|integer|min:0',
                'tipo'        => 'sometimes|in:camiseta,figura',
                'talla'       => 'nullable|string',
                'material'    => 'nullable|string',
                'tamano'      => 'nullable|string'
            ]);

            $producto->update($datosValidados);
            return response()->json(["mensaje" => "Producto actualizado", "producto" => $producto]);

        } catch (ValidationException $e) {
            return response()->json(["errores" => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json(["mensaje" => "Producto enviado a la papelera"]);
    }
}