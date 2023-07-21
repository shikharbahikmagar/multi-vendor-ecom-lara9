<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorDetails = [
            ['id'=>1, 'name'=>'shikhar', 'address'=>'bijaypur', 'city'=>'pokhara', 'state'=>'gandaki',
            'country'=>'nepal', 'pincode'=>'33700', 'mobile'=>'9824142088', 'email'=>'shikhar@vendor.com', 'status'=>1
        ],

    ];
    Vendor::insert($vendorDetails);
    }
}
