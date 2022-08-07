<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
    protected $connection = 'mysql';
    protected $table = "adicional";
    protected $fillable = ['id', 'nombreAdicional', 'precioAdicional', 'descripcionAdicional', 'subCategoriaAdicional', 'estadoAdicional', 'fotoAdicional'];
}
