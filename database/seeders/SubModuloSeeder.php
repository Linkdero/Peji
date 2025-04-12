<?php

namespace Database\Seeders;

use App\Models\Modulo;
use App\Models\SubModulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubModuloSeeder extends Seeder
{
    public function run(): void
    {

        $submodulos = [
            // Submódulos para Dashboard
            ['id_modulo' => 1, 'sub_modulo_detalle' => 'Gráficas', 'activo' => true],

            // Submódulos para Publicaciones
            ['id_modulo' => 2, 'sub_modulo_detalle' => 'Noticias', 'activo' => true],

            // Submódulos para Referencias
            ['id_modulo' => 3, 'sub_modulo_detalle' => 'Categorias', 'activo' => true],
            ['id_modulo' => 3, 'sub_modulo_detalle' => 'Tags', 'activo' => true],

        ];

        foreach ($submodulos as $submodulo) {
            SubModulo::create($submodulo);
        }

        $this->command->info('Tabla tbl_sub_modulo poblada correctamente!');
    }
}
