<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    public function usuario(){
        return $this->hasOne('App\Models\User', 'id', 'id_usuario');
    }

    public function producto(){
        return $this->hasOne('App\Models\Producto', 'id', 'id_producto');
    }

    protected $fillable = [
        'cantidad',
    ];
    
}
