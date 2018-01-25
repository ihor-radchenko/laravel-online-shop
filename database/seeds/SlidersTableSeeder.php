<?php

use AutoKit\Slider;
use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'title' => '<span style="color: white">Надежные автозапчасти</span>',
            'description' => 'Лучшие обвесы для кузова',
            'img' => 'slide_1_lt_5.jpg',
            'menu_id' => 2
        ]);
        Slider::create([
            'title' => 'Надежные автозапчасти',
            'description' => '<span class="color-black">Двигателя и турбочарджеры</span>',
            'img' => 'slide_2_lt_5.jpg',
            'menu_id' => 4
        ]);
        Slider::create([
            'title' => '<span style="color: white">Надежные автозапчасти</span>',
            'description' => 'Лучшие обвесы для кузова',
            'img' => 'slide_3_lt_5.jpg',
            'menu_id' => 5
        ]);
    }
}
