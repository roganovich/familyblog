<?php

use Illuminate\Database\Seeder;
use App\Models\Blog\Post;
use App\Models\Blog\Category;
use App\Models\Blog\PostsCategories;

class PostsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogs = $items = Post::select(['id'])->get();
        $categoryes =  $items = Category::select(['id'])->get()->toArray();

        foreach ($blogs as $blog){
            $randCateg = array_rand($categoryes, rand(2,5));

            foreach ($randCateg as $categorie_id) {
                $model = new PostsCategories();
                $model->category_id = $categoryes[$categorie_id]['id'];
                $model->post_id = $blog->id;
                $model->save();
            }
        }

    }
}
