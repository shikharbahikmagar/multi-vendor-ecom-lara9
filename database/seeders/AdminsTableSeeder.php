<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //password = 123456
        $adminRecords = [
            ['id'=>2, 'name'=>'shikhar bahik', 'type'=>'vendor', 'vendor_id'=>1, 'mobile'=>'9824142088',
            'email'=>'shikhar@vendor.com', 'password' => '$2y$10$uOsrequDmEXR41z2qFAXA.vH0NoykvKqLbMdTIS8aD7pgirfgooTa',
            'image'=>'', 'status'=>1],

        ];
        Admin::insert($adminRecords);
    }
}
