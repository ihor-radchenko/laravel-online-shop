<?php

use AutoKit\Review;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::create([
            'title' => 'nice',
            'text' => 'Супер, классные барабаны',
            'rating' => 5,
            'name' => 'John Doe',
            'product_id' => 2
        ]);
        Review::create([
            'title' => 'Ну такое',
            'text' => 'мда...зря потраченные деньги',
            'rating' => 2,
            'name' => 'KOKOC',
            'user_id' => 1,
            'product_id' => 2
        ]);
    }
}
