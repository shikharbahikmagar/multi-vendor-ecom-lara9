<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBankDetail;

class VendorsBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorsBankRecords = [
            ['id'=>1, 'vendor_id'=>1, 'account_holder_name'=>'shikhar bahik', 'bank_name'=>'global ime', 'account_number'=>'160201002345', 'bank_ifsc_code'=>'123456'],        
        ];
        VendorsBankDetail::insert($vendorsBankRecords);
        }
}
