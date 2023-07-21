<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBusinessDetail;


class VendorsBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorBusinessRecords = [
            ['id'=>1, 'vendor_id'=>1, 'shop_name'=>'mero_kapada', 'shop_address'=>'bijaypur', 'shop_city'=>'pokhara', 'shop_state'=>'gandaki', 'shop_country'=>'nepal',
            'shop_pincode'=> '33700', 'shop_mobile'=>'9824142088', 'shop_website'=>'merokapada.com', 'shop_email'=>'merokapada@vendor.com', 'address_proof'=>'passport', 'address_proof_image'=>'pass.jpeg',
            'business_license_number'=>'123456789', 'gst_number'=>'123456', 'pan_number'=>'123456'],
        ];
        VendorsBusinessDetail::insert($vendorBusinessRecords);
    }
}
