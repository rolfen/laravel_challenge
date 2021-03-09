<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Author;
use App\Models\Library;
use App\Models\Book;


Route::get('/', function () {

	$data = [
		"books" => Book::with('author', 'libraries')->get()->toArray()
	];

    return view('list', $data);
});


Route::get('/edit/{id}', function ($id) {
	$book = Book::find($id);
	$libraries = $book->libraries;
	$author_list = Author::pluck('name','id')->toArray();
	$library_list = Library::pluck('name','id')->toArray();


    return view('edit', [
    	'book' => $book,
    	'author' => $book->author,
    	'libraries' => $libraries,
    	'author_list' => $author_list,
    	'library_list' => $library_list
    ]);
});
