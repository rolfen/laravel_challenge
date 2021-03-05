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

    public function test_get_book() 
    {

    	$book = Book::factory()->create();

    	$res = $this->get('/api/book/'.$book->id);

    	$res->assertJson($book->details);
    }

    public function test_post_book() {

    	$new_book = Book::factory()->make();
    	$new_details = $new_book->details;

    	$response = $this
    		->withHeaders([
    			'Accept' => 'application/json'
    		])
    		->post('/api/book', $new_details);


    	if ($response->status() == 200)     	{
	    	$saved_details = Book::find($response->content())->details;
	    	unset($saved_details["id"]);
	    	$this->assertEquals($new_details, $saved_details);	    	
    	} else {
    		$this->fail("Request failed.");
    		dump($response);
    	}

 
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
