<?php

use AutoKit\Comment;
use AutoKit\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(SlidersTableSeeder::class);
//        $this->call(CommentsTableSeeder::class);
//        $this->call(ReviewsTableSeeder::class);
        factory(Review::class, 500)->create();
        factory(Comment::class, 50)->create();
    }
}
