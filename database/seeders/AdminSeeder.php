<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('usuarios')->insert([
            'usuario' => 'Administrador',
            'email' => 'admin@admin',
            'senha' => Hash::make('admin'),
            'acesso' => 'Administrador',
        ]);
    }
}


