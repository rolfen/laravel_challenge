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

	// dd( Book::with('author')->get()->toArray() );

	$data = [
		"books" => Book::with('author', 'libraries')->get()->toArray()
	];

    return view('list', $data);
});


Route::get('/edit/{id}', function ($id) {

	// dd( Book::with('author')->find($id)->toArray() );

    return view('edit', [
    	'book' => Book::with('author', 'libraries')->find($id)->toArray(),
    	'author_list' => Author::pluck('name','id')->toArray()
    ]);
});
