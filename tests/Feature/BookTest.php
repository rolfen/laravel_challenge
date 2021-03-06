<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Book;

class BookTest extends TestCase
{

    use RefreshDatabase;

    protected function get_details($book) 
    {
        $expected = [
            'title' => $book->name,
            'author' => $book->author->name,
            'author_id' => $book->author->id,
            'genre' => $book->author->genre,
            'year' => $book->year,
            'libraries' => []
        ];
        if(isset($book->id)) {
            $expected['id'] = $book->id;
        }
        if(isset($book->libraries)) {
            foreach ($book->libraries as $library) {
                array_push($expected['libraries'],[
                    'id' => $library->id,
                    'name' => $library->name,
                    'address' => $library->address
                ]);
            }            
        }
        return $expected;
    }

    /**
     * Test book details on the model
     *
     * @return void
     */
    public function test_get_book_details() 
    {
        $book = Book::factory()->create();
        $this->assertEquals($book->details, $this->get_details($book));
    }


}
