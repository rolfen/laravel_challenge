<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithFaker;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

use App\Models\Author;
use App\Models\Library;
use App\Models\Book;


/*

TODO:

Test that book-related libraries are being loaded and handled correctly

*/

class ApiTest extends TestCase
{

	use RefreshDatabase;

	protected function api() {
		return 
			$this->withHeaders([
    			'Accept' => 'application/json'
    		])
    	;
	}

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_online()
    {
        $response = $this->api()->get('/api/');

        $response->assertStatus(200);
    }

    public function test_list() 
    {

    	$details = Book::factory()->count(5)->create()->map(function ($book)
    	{
    		return $book->details;
    	});

    	$response = $this->api()->get('/api/books');

    	$response->assertStatus(200);

    	$response->assertJson($details->toArray());

    }


    public function test_fetch() 
    {
    	$book = Book::factory()->create();

    	$response = $this->api()->get('/api/book/'.$book->id);

    	$response->assertJson($book->details, $response->content());
    }

    public function test_create() 
    {

    	$details = Book::factory()->make()->details;

    	$response = $this->api()->post('/api/book', $details);

    	$this->assertEquals($response->status(), 200);

		$saved_details = Book::find($response->content())->details;
	    unset($saved_details["id"]);
    	$this->assertEquals($details, $saved_details);	    	

    }

    public function test_amend() 
    {
    	// Create book in DB to be edited

    	$book = Book::factory()->create();

    	// Create some details

    	$details = Book::factory()->make()->details;

    	$response = $this->api()->post('/api/book/'.$book->id , $details);

    	$details['id'] = $book->id;

    	$this->assertEquals($response->status(), 200);

    	$this->assertEquals($details, Book::find($book->id)->details);	    	

    }
}
