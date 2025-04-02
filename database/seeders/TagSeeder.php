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
            ['tag_detalle' => 'Oferta', 'id_estado' => 1],
            ['tag_detalle' => 'Nuevo', 'id_estado' => 1],
            ['tag_detalle' => 'Popular', 'id_estado' => 1],
            ['tag_detalle' => 'Limitado', 'id_estado' => 1],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
