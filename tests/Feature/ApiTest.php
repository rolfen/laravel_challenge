<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithFaker;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

use App\Models\Author;
use App\Models\Book;

class ApiTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */

    /*
    public function test_please_fail()
    {
        $this->assertTrue(false, "This is supposed to fail");
    }
	*/


    public function test_a_basic_request()
    {
        $response = $this->get('/api/');

        $response->assertStatus(200);
    }

    public function test_get_author()
    {

    	$author = Author::factory()->create();

        $response = $this->get('/author/1');

        $this->assertEquals($response['name'], $author->name);

        $this->assertEquals($response['year'], $author->year);


    }

    public function test_sanity()
    {
        $this->assertTrue(true, "Nothing makes sense");
    }


    public function post_book()
    {

    	$book = Book::factory()->create();

        $response = $this->post('/book',[
        	'id' => 1,
        	'name' => $book->name,
        	'year' => $book->year
        ]);

        $stored = Book::find(1);



    }

}
