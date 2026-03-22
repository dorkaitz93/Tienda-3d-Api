<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Producto;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'cliente_nombre', 
        'cliente_email', 
        'direccion', 
        'total', 
        'estado'
    ];

    // Relación: Un pedido pertenece a un usuario (opcional si es invitado)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: Un pedido tiene muchos productos (Muchos a Muchos)
    public function productos()
    {
        return $this->belongsToMany(Producto::class)
                    ->withPivot('cantidad', 'precio_unitario')
                    ->withTimestamps();
    }
    
}