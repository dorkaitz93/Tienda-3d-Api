<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
// No olvides importar el seeder de productos si no lo hace solo el IDE
use Database\Seeders\ProductoSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Ejecutamos el seeder de los productos "originales"
        $this->call([
            ProductoSeeder::class,
        ]);

        // 2. Aquí podrías añadir más en el futuro, por ejemplo:
        // $this->call(UserSeeder::class);
        // $this->call(CategoriaSeeder::class);
    }
}