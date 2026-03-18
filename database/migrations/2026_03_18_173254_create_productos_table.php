<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            // Relación con la tabla categorías
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            
            $table->string('nombre');
            $table->string('enlace')->unique(); 
            $table->text('descripcion');       
            $table->decimal('precio', 8, 2);   
            $table->integer('stock')->default(0); 
            $table->string('imagen_url')->nullable(); 

            // Campos específicos
            $table->string('talla')->nullable();      
            $table->string('material')->nullable();   
            $table->string('dimensiones')->nullable(); 

            $table->softDeletes();             
            $table->timestamps();
        });
    } // <-- Aquí solo va UNA llave para cerrar el método up

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    } // <-- Aquí NO va punto y coma
};