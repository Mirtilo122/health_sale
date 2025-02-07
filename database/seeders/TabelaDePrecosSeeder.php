<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TabelaDePrecosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tabela_de_precos')->insert([
            'nome' => 'Tabela Teste',
            'descricao' => 'Tabela para Testes no Sistema',
            'ativo' => true,
            'convenio' => 'Nenhum',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

