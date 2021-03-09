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
    		return $book->getDetails();
    	});

    	$response = $this->api()->get('/api/books');

    	$response->assertStatus(200);

    	$response->assertJson($details->toArray());

    }


    public function test_fetch() 
    {
    	$book = Book::factory()->create();

    	$response = $this->api()->get('/api/book/'.$book->id);

    	$response->assertJson($book->getDetails(), $response->content());
    }

    public function test_create() 
    {

    	$book = Book::factory()->create();


		$new_libraries = collect(Library::factory()->count(1)->make());
		$saved_libraries = collect(Library::factory()->count(3)->create());
		$libraries = $saved_libraries->merge($new_libraries);

    	$book->setRelation(
    		'libraries',
    		$libraries
    	);

    	$book_details = $book->getDetails();

	    unset($book_details["id"]);
    	$response = $this->api()->post('/api/book', $book_details);

    	$this->assertEquals($response->status(), 200);

    	// fetch ID of created book and find it in the DB
		$saved_details = Book::find($response->content())->getDetails();	    


		// unset all newly generated IDs to pass tests
	    unset($saved_details["id"]);
	    unset($book_details['libraries'][array_key_last($book_details['libraries'])]['id']);
	    unset($saved_details['libraries'][array_key_last($book_details['libraries'])]['id']);

    	$this->assertEquals($book_details, $saved_details);	    	

    }

    public function test_amend() 
    {
    	// Create book in DB to be edited

    	$book = Book::factory()->create();

    	// Create some details

    	$details = Book::factory()->make()->getDetails();

    	$response = $this->api()->post('/api/book/'.$book->id , $details);

    	$details['id'] = $book->id;

    	$this->assertEquals($response->status(), 200);

    	$this->assertEquals($details, Book::find($book->id)->getDetails());	    	

    }
}
