<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Noticia>
 */
class NoticiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'noticia_titulo' => $this->faker->sentence,
            'noticia_detalle' => $this->faker->paragraphs(3, true),
            'miniatura' => $this->faker->optional()->imageUrl(640, 480),
            'id_usuario_creador' => User::factory(),
            'id_estado' => function () {
                return \App\Models\Estado::inRandomOrder()->first()->id_estado ??
                    \App\Models\Estado::factory()->create()->id_estado;
            },
            'id_categoria' => function () {
                return \App\Models\Categoria::inRandomOrder()->first()->id_categoria ??
                    \App\Models\Categoria::factory()->create()->id_categoria;
            },
            'fecha_creacion' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'created_at' => $this->faker->dateTimeThisYear(),
            'updated_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
