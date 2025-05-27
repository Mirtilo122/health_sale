<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeloPadraoSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            'condicoes_gerais',
            'pagamento_hospital',
            'pagamento_cirurgiao',
            'pagamento_anestesista',
        ];

        foreach ($tipos as $tipo) {
            DB::table('modelo_padroes')->insert([
                'tipo' => $tipo,
                'modelo_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
