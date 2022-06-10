<?php

use Illuminate\Database\Seeder;

use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Opinion',
                'color' => 'primary'
            ],
            [
                'name' => 'Sport',
                'color' => 'secondary'
            ],
            [
                'name' => 'Culture',
                'color' => 'success'
            ],
            [
                'name' => 'Lifestyle',
                'color' => 'warning'
            ],
            [
                'name' => 'Science',
                'color' => 'info'
            ],
        ];

        foreach($categories as $data){
            $category = new Category();
            
            $category -> name = $data['name'];
            $category -> color = $data['color'];
            
            $category->save();
        }
    }
}
