<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['tag_detalle' => 'Cerveceria', 'id_estado' => 1],
            ['tag_detalle' => 'Colegio Maya', 'id_estado' => 1],
            ['tag_detalle' => 'Colegio Valle Verde', 'id_estado' => 1],
            ['tag_detalle' => 'Grupo Hame', 'id_estado' => 1],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
