<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Producto;
class Orden extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto'); 
    }

    protected $fillable = [
        'id_producto',
        'id_usuario',
        'cantidad',
    ];
}
