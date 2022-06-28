<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoUsuario = [
            'admin',
            'entrega',

        ];
        foreach($tipoUsuario as $key => $value){
            DB::table('tipo_usuario')->insert([
                'nombreTipoUsuario' => $value,
                
            ]);
        }
    }
}
