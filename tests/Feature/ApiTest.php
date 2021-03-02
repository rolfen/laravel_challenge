<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;


use Test\TestCase;

use App\Author;

class AuthorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */


    public function test_a_basic_request()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_author()
    {

    	$author = Author::factory()->create();

        $response = $this->get('/author/1');

    }

}
