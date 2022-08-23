<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $connection = 'mysql';
    protected $table = "pedido";
    protected $fillable = ['id', 'usuario', 'cliente', 'domiciliario', 'tipoPago', 'tipoPedido', 'estadoPedido', 'observacion', 'total'];
}
