<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoPago = [
            'Efectivo',
            'Trasnferencia',
            'Datafono',
            'Credito',
            'Contrato',
        ];
        foreach($tipoPago as $key => $value){
            DB::table('tipo_pago')->insert([
                'nombreTipoPago' => $value,
                
            ]);
        }
    }
}
