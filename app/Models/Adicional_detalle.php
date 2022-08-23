<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adicional_detalle extends Model
{
    protected $connection = 'mysql';
    protected $table = "adicional_detalle";
    protected $fillable = ['id', 'adicional', 'detalle', 'cantidad'];
}
