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

Route::get('/authors/{author}', function (Author $author) {
    return $author;
});

Route::get('/authors/{author}/books', function (Author $author) {
    return $author->books()->get();
});

Route::get('/books/{book}', function (Book $book) {
    return $book;
});

Route::get('/books/{book}/libraries', function (Book $book) {
    return $book->libraries()->get();
});

Route::get('/libraries/{library}', function (Library $library) {
    return $library;
});