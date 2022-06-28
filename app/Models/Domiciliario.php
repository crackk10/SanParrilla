<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domiciliario extends Model
{
    protected $connection = 'mysql';
    protected $table = "domiciliario";
    protected $fillable = ['id','documentoDomiciliario', 'nombreDomiciliario', 'apellidoDomiciliario','fotoSeguridad','telefonoDomiciliario','estadoDomiciliario',];

}
