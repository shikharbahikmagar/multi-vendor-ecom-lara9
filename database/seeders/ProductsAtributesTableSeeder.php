<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsAttribute;

class ProductsAtributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributesRecords = [
            ['id'=>1, 'product_id'=>1, 'size'=>'small', 'price'=>2500, 'stock'=>5, 'sku'=>'S', 'status'=>1],
            ['id'=>2, 'product_id'=>1, 'size'=>'medium', 'price'=>3000, 'stock'=>10, 'sku'=>'M', 'status'=>1],
            ['id'=>3, 'product_id'=>1, 'size'=>'large', 'price'=>3200, 'stock'=>12, 'sku'=>'L', 'status'=>1],
        ];
        ProductsAttribute::insert($attributesRecords);
    }
}
