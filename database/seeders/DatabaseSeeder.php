<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
// No olvides importar el seeder de productos si no lo hace solo el IDE
use Database\Seeders\ProductoSeeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin Tienda3D',
            'email' => 'admin@tienda3d.com', 
            'password' => bcrypt('admin1234'),
            'tipo_usuario' => 'admin',
        ]);

        $this->call([
            ProductoSeeder::class,
        ]);
    }
}