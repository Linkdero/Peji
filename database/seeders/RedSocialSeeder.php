<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RedSocial;

class RedSocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $redes = [
            [
                'red_social_detalle' => 'Facebook',
                'icon' => 'bi bi-facebook'
            ],
            [
                'red_social_detalle' => 'Instagram',
                'icon' => 'bi bi-instagram'
            ],
            [
                'red_social_detalle' => 'Twitter',
                'icon' => 'bi bi-twitter'
            ],
            [
                'red_social_detalle' => 'LinkedIn',
                'icon' => 'bi bi-linkedin'
            ],
            [
                'red_social_detalle' => 'YouTube',
                'icon' => 'bi bi-youtube'
            ],
            [
                'red_social_detalle' => 'TikTok',
                'icon' => 'bi bi-tiktok'
            ],
        ];

        foreach ($redes as $red) {
            RedSocial::create($red);
        }
    }
}
