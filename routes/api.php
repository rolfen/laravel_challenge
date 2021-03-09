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

Route::get('/', function () {
    return "OK";
});


Route::get('/books', function () {
    return Book::all()->map(function($book){
    	return $book->getDetails();
    });
});

Route::get('/book/{book}', function (Book $book) {
    return $book->getDetails();
});

Route::post('/book/{book}', function (Book $book, Request $req) {
	// $book = Book::firstOrNew(['id' => $req->all()['id']]);
	$book->saveDetails($req->all());
    return $book->id;
});

Route::post('/book', function (Request $req) {
	$book = Book::make();
	$book->saveDetails($req->all());
    return $book->id;
});
