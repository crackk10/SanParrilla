<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_pedido extends Model
{
    protected $connection = 'mysql';
    protected $table = "detalle_pedido";
    protected $fillable = ['id', 'plato', 'pedido', 'cantidad'];
}
