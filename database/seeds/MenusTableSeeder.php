<?php

use Illuminate\Database\Seeder;
use AutoKit\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'title' => 'Интерьер',
            'alias' => 'interior'
        ]);
        Menu::create([
            'title' => 'Экстерьер',
            'alias' => 'exterior'
        ]);
        Menu::create([
            'title' => 'Освещение',
            'alias' => 'lighting'
        ]);
        Menu::create([
            'title' => 'Запчасти',
            'alias' => 'repair-parts'
        ]);
        Menu::create([
            'title' => 'Кузов',
            'alias' => 'body-parts'
        ]);
        Menu::create([
            'title' => 'Блог',
            'alias' => 'blog'
        ]);
    }
}
