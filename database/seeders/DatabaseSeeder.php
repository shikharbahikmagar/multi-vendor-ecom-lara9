<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(AdminsTableSeeder::class);
        //$this->call(VendorsTableSeeder::class);
        //$this->call(VendorsBusinessDetailsTableSeeder::class);
        //$this->call(VendorsBankDetailsTableSeeder::class);
        //$this->call(CategoriesTableSeeder::class);
        //  $this->call(AuthorsTableSeeder::class);
        // $this->call(SectionsTableSeeder::class);
        // $this->call(BrandsTableSeeder::class);
         //$this->call(ProductsTableSeeder::class);
         //$this->call(ProductsAtributesTableSeeder::class);
        //  $this->call(ProductsImageTableSeeder::class);
        $this->call(BannersTableSeeder::class);


    }
}
