<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        
        $this->call(BooksSeeder::class);

        $this->call(UsersSeeder::class);
    }
}
