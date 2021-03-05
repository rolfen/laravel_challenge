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

    public function test_post_book_create() 
    {

    	$details = Book::factory()->make()->details;

    	$response = $this
    		->withHeaders([
    			'Accept' => 'application/json'
    		])
    		->post('/api/book', $details);

    	$this->assertEquals($response->status(), 200);

		$saved_details = Book::find($response->content())->details;
	    unset($saved_details["id"]);
    	$this->assertEquals($details, $saved_details);	    	

    }

    public function test_post_book_edit() 
    {
    	// Create book in DB to be edited

    	$book = Book::factory()->create();

    	// Create some details

    	$details = Book::factory()->make()->details;

    	$response = $this
    		->withHeaders([
    			'Accept' => 'application/json'
    		])
    		->post('/api/book/'.$book->id , $details);

    	$details['id'] = $book->id;

    	$this->assertEquals($response->status(), 200);

    	$this->assertEquals($details, Book::find($book->id)->details);	    	

    }

    public function test_sanity()
    {
        $this->assertTrue(true, "Nothing makes sense");
    }
}
