<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsImage;

class ProductsImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageRecords = [
            ['id'=>1, 'product_id'=>2, 'image'=>'img.png', 'status'=>1], ['id'=>2, 'product_id'=>4, 'image'=>'img1.png', 'status'=>1],

        ];
        ProductsImage::insert($imageRecords);
    }
}
