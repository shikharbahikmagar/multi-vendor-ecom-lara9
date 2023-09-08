<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannersRecords = [
            ['id'=>1, 'image'=>'img.jpg', 'link'=>'imge1', 'title'=>'image1', 'alt'=>'image ho', 'status'=>1],
            ['id'=>2, 'image'=>'img1.jpg', 'link'=>'imge2', 'title'=>'image2', 'alt'=>'image ho', 'status'=>1],
            ['id'=>3, 'image'=>'img2.jpg', 'link'=>'imge3', 'title'=>'image3', 'alt'=>'image ho', 'status'=>1],
        ];
        Banner::insert($bannersRecords);
    }
}
