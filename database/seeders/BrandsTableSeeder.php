<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords = [
            ['id'=>1, 'name'=>'Gucci', 'status'=>1],
            ['id'=>2, 'name'=>'Nike', 'status'=>1],
            ['id'=>3, 'name'=>'Adidas', 'status'=>1],

        ];

        Brand::insert($brandRecords);
    }
}
