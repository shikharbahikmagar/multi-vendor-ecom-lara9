<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionRecords = [
            ['id'=>1, 'name'=>'Clothing', 'Status'=>1],
            ['id'=>2, 'name'=>'Electronics', 'Status'=>1],
            ['id'=>3, 'name'=>'Appliances', 'Status'=>1]
        ];

        Section::insert($sectionRecords);
    }
}
