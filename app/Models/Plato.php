<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    protected $connection = 'mysql';
    protected $table = "plato";
    protected $fillable = ['id','nombrePlato','precio','descripcion','categoriaPlato','estadoPlato',];

}
