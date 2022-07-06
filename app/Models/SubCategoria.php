<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    protected $connection = 'mysql';
    protected $table = "sub_categoria";
    protected $fillable = ['id','nombreSubCategoriaPlato','categoria','estadoSubCategoria'];

}
