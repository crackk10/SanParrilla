<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $connection = 'mysql';
    protected $table = "categoria";
    protected $fillable = ['id', 'nombreCategoriaPlato','estadoCategoria'];

}
