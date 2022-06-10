<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

use App\Models\Post;
use App\Models\Category;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $arrayCategories = Category::pluck('id') -> toArray();
        for($i = 0; $i < 10; $i++){

            $post = new Post();
            $post -> title = $faker -> text(10);
            $post -> category_id = Arr::random($arrayCategories);
            $post -> slug = Str::slug($post->title, '-');
            $post -> content = $faker -> paragraph();
            $post -> image = $faker -> imageUrl(250, 250);
            $post -> firm = $faker -> name() ;
            $post -> save();
        }
    }
}
