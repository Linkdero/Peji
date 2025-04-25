<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;
use App\Models\Estado;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            ['banner' => 'banner1.webp', 'id_estado' => 1],
            ['banner' => 'banner2.webp', 'id_estado' => 1],
            ['banner' => 'banner3.webp', 'id_estado' => 1],
            ['banner' => 'banner4.webp', 'id_estado' => 1],
            ['banner' => 'banner5.webp', 'id_estado' => 1],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
