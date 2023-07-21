<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorsRecords = [
            ['id'=> 1, 'vendor_id'=>1, 'author_name'=>'James Clear', 'date_of_birth'=>'1985-11-22', 'nationality'=>'American', 'Genre'=>'Self-Help Book',
            'books_available'=>4],
        ];
        Author::insert($authorsRecords);
    }
}
