<?php

use AutoKit\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'title' => 'LEMFÖRDER',
            'alias' => 'lemforder'
        ]);
        Brand::create([
            'title' => 'ELIT',
            'alias' => 'elit'
        ]);
        Brand::create([
            'title' => 'LIQUI MOLY',
            'alias' => 'liqui-moly'
        ]);
        Brand::create([
            'title' => 'MTS',
            'alias' => 'mts'
        ]);
        Brand::create([
            'title' => 'GKN',
            'alias' => 'gkn'
        ]);
        Brand::create([
            'title' => 'BILSTEIN',
            'alias' => 'bilstein'
        ]);
        Brand::create([
            'title' => 'BREMBO',
            'alias' => 'brembo'
        ]);
        Brand::create([
            'title' => 'ENGINETEAM',
            'alias' => 'engineteam'
        ]);
    }
}
