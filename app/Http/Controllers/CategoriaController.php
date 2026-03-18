<?php

namespace App\Http\Controllers;

use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        // Trae todas las categorías para el menú de navegación
        return response()->json(Categoria::all());
    }

    public function show(Categoria $categoria)
    {
        // Trae una categoría específica con todos sus productos
        return response()->json($categoria->load('productos'));
    }
}