<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoSeeder extends Seeder
{
   
    
        public function run(): void
{
    // 1. Crear las categorías base
    $camisetas = Categoria::create(['nombre' => 'Camisetas', 'slug' => 'camisetas']);
    $figuras = Categoria::create(['nombre' => 'Figuras 3D', 'slug' => 'figuras-3d']);

    // 2. Crear productos usando las relaciones
    $camisetas->productos()->create([
        'nombre' => 'Camiseta Logo 3D',
        'enlace' => 'camiseta-logo-3d',
        'descripcion' => 'Camiseta de algodón premium con logo en relieve.',
        'precio' => 19.99,
        'stock' => 50,
        'talla' => 'L',
        'material' => 'Algodón',
        'imagen_url' => 'productos/camiseta.jpg'
    ]);

    $figuras->productos()->create([
        'nombre' => 'Figura Dragón Guerrero',
        'enlace' => 'figura-dragon-guerrero',
        'descripcion' => 'Figura épica impresa en resina de alta definición.',
        'precio' => 45.00,
        'stock' => 10,
        'material' => 'Resina',
        'dimensiones' => '15cm (Escala 1:12)',
        'imagen_url' => 'productos/dragon.jpg'
    ]);
}
    
}

