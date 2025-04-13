<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dia;

class DiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dias = [
            ['dia_detalle' => 'Lunes'],
            ['dia_detalle' => 'Martes'],
            ['dia_detalle' => 'Miércoles'],
            ['dia_detalle' => 'Jueves'],
            ['dia_detalle' => 'Viernes'],
            ['dia_detalle' => 'Sábado'],
            ['dia_detalle' => 'Domingo'],
            ['dia_detalle' => 'Todos'],
        ];

        foreach ($dias as $dia) {
            Dia::create($dia);
        }
    }
}
