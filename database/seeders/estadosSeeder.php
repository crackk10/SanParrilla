<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class estadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            'Activo',
            'Inactivo',
            'Pago',
            'No Pago',
            'cancelado',
        ];
        foreach($estados as $key => $value){
            DB::table('estados')->insert([
                'nombreEstado' => $value,
                
            ]);
        }
    }
}
