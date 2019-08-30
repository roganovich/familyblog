<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(\App\Models\Blog\Category::class,10)->create();
        factory(\App\Models\Blog\Post::class,100)->create();
        $this->call(PostsCategoriesTableSeeder::class);
    }
}


