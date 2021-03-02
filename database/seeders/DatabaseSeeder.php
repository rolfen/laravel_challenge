<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Book;
use App\Models\Author;
use App\Models\Library;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

    	$author1 = Author::factory()->create();
    	$author2 = Author::factory()->create();


        $bookFactory1 = Book::factory()
        	->count(3)
        	->for($author1);

        $bookFactory2 = Book::factory()
        	->count(2)
        	->for($author2);


        Library::factory()
        	->count(2)
        	->has($bookFactory1)
        	->create();

        Library::factory()
        	->count(2)
        	->has($bookFactory2)
        	->create();


    }
}
