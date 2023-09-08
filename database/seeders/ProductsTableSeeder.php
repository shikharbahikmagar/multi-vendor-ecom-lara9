<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            ['id'=>1, 'section_id'=>1, 'category_id'=>1, 'brand_id'=>1, 'vendor_id'=>1, 'admin_type'=>'vendor', 'product_name'=>'iphone xr', 'product_code'=>'IPHN10', 'product_color'=>'black',
            'product_price'=>'50000', 'product_discount'=>'20', 'product_weight'=>'5', 'product_image'=>'image', 'product_video'=> '', 'description'=>'test', 'meta_title'=>'test', 'meta_description'=>'test'
            ,'meta_keywords'=>'test', 'is_featured'=>'Yes', 'status'=>1],
            ['id'=>2, 'section_id'=>1, 'category_id'=>1, 'brand_id'=>1, 'vendor_id'=>1, 'admin_type'=>'vendor', 'product_name'=>'iphone xr', 'product_code'=>'IPHN10', 'product_color'=>'black',
            'product_price'=>'50000', 'product_discount'=>'20', 'product_weight'=>'5', 'product_image'=>'image', 'product_video'=> '', 'description'=>'test', 'meta_title'=>'test', 'meta_description'=>'test'
            ,'meta_keywords'=>'test', 'is_featured'=>'Yes', 'status'=>1]
        ];

        Product::insert($productRecords);
    }
}
