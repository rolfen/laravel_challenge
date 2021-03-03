<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Book;

class BookTest extends TestCase
{
    /**
     * Test book details on the model
     *
     * @return void
     */
    public function test_book_details() {
        $book = Book::factory()->create();

        $expected = [
            'title' => $book->name,
            'author' => $book->author->name,
            'genre' => $book->author->genre,
            'year' => $book->year
        ];

        foreach ($book->libraries as $library) {
            array_push($expected['libraries'],[
                'id' => $library->id,
                'name' => $library->name,
                'address' => $library->address
            ]);
        }

        $this->assertEquals($book->details, $expected);
    }
}
