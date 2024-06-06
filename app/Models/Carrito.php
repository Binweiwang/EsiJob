<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carrito';

    protected $fillable = [
        'user_id',
        'producto_id',
        'quantity',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getTotalPriceAttribute()
    {
        return $this->producto->precio * $this->quantity;
    }
}
