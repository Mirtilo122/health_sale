<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadesSeeder extends Seeder {
    public function run() {
        $especialidades = [
            'Acupuntura', 'Alergia e imunologia', 'Anestesiologia', 'Angiologia',
            'Cardiologia', 'Cirurgia cardiovascular', 'Cirurgia da mão', 'Cirurgia de cabeça e pescoço',
            'Cirurgia do aparelho digestivo', 'Cirurgia geral', 'Cirurgia oncológica', 'Cirurgia pediátrica',
            'Cirurgia plástica', 'Cirurgia torácica', 'Cirurgia vascular', 'Clínica médica',
            'Coloproctologia', 'Dermatologia', 'Endocrinologia e metabologia', 'Endoscopia',
            'Gastroenterologia', 'Genética médica', 'Geriatria', 'Ginecologia e obstetrícia',
            'Hematologia e hemoterapia', 'Homeopatia', 'Infectologia', 'Mastologia',
            'Medicina de emergência', 'Medicina de família e comunidade', 'Medicina do trabalho', 'Medicina do tráfego',
            'Medicina esportiva', 'Medicina física e reabilitação', 'Medicina intensiva', 'Medicina legal e perícia médica',
            'Medicina nuclear', 'Medicina preventiva e social', 'Nefrologia', 'Neurocirurgia',
            'Neurologia', 'Nutrologia', 'Oftalmologia', 'Oncologia clínica',
            'Ortopedia e traumatologia', 'Otorrinolaringologia', 'Patologia', 'Patologia clínica/medicina laboratorial',
            'Pediatria', 'Pneumologia', 'Psiquiatria', 'Radiologia e diagnóstico por imagem',
            'Radioterapia', 'Reumatologia', 'Urologia'
        ];

        foreach ($especialidades as $especialidade) {
            DB::table('especialidades')->insert([
                'nome' => $especialidade,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
