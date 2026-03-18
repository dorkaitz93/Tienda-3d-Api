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
    Schema::create('pedidos', function (Blueprint $table) {
        $table->id();
        // Nullable porque un invitado no tiene user_id
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        
        // Datos del cliente (imprescindibles para el envío)
        $table->string('cliente_nombre');
        $table->string('cliente_email');
        $table->string('direccion');
        
        $table->decimal('total', 10, 2);
        $table->string('estado')->default('pendiente'); // pendiente, pagado, enviado
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
