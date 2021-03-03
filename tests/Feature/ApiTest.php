<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithFaker;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

use App\Models\Author;
use App\Models\Library;
use App\Models\Book;

class ApiTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */


    public function test_a_basic_request()
    {
        $response = $this->get('/api/');

        $response->assertStatus(200);
    }

    public function test_get_book() {

    	$book = Book::factory()->create();

    	$res = $this->get('/api/book/'.$book->id);

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

    	$res->assertJson($expected);
    }

    public function test_get_author()
    {

    	$author = Author::factory()->create();

        $response = $this->get('/api/author/'.$author->id);

        $response->assertJson([
        	'name' => $author->name,
        	'birth_date' => $author->birth_date
        ]);
    }

    public function test_get_library_books() {

    	$author = Library::factory()->create();
    }

    public function edit_book()
    {

    	$book = Book::factory()->create();

    	$book2 = Book::factory()->make();

        $response = $this->post('/book',[
        	'id' => $book->id,
        	'name' => $book2->name,
        	'year' => $book2->year
        ]);

        $stored = Book::find($book->id);

        $this->assertEquals($response['name'], $author->name);

        $this->assertEquals($response['birth_date'], $author->birth_date);


    }

    public function test_sanity()
    {
        $this->assertTrue(true, "Nothing makes sense");
    }


}
