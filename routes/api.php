<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Book;
use App\Models\Author;
use App\Models\Libraries;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function (Author $author) {
    return "OK";
});

Route::get('/author/{author}', function (Author $author) {
    return $author;
});

Route::get('/author/{author}/books', function (Author $author) {
    return $author->books()->get();
});

Route::get('/book/{book}', function (Book $book) {
	$details = [
    	'title' => $book->name,
    	'year' => $book->year,
    	'author' => $book->author->name,
    	'genre' => $book->author->genre,
    	'libraries' => []
    ];
    foreach ($book->libraries as $library) {
    	array_push($details['libraries'],[
  	    	'id' => $library->id,
    		'name' => $library->name,
    		'address' => $library->address
    	]);
    }
    return $details;
});

Route::get('/book/{book}/libraries', function (Book $book) {
    return $book->libraries()->get();
});

Route::get('/library/{library}/books', function (Library $library) {
    return $library->with('books')->get();
});