<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $categoriesRecords = [
            ['id'=>1, 'category_name'=>'Technology', 'category_image'=>'', 'category_discount'=>2, 'description'=>'technology books', 'url'=>'techs-books', 'meta_title'=>'Tech', 'meta_description'=>'tech',
            'meta_keywords'=>'techs', 'status'=>1],
            ['id'=>2, 'category_name'=>'Fiction', 'category_image'=>'', 'category_discount'=>2, 'description'=>'fiction books', 'url'=>'fiction-books', 'meta_title'=>'fiction', 'meta_description'=>'fiction',
            'meta_keywords'=>'fiction', 'status'=>1],
        ];
        Category::insert($categoriesRecords);
    }
}
