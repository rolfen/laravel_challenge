<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Author;
use App\Models\Library;
use App\Models\Book;

class AdminController extends Controller
{
	function listBooks(Request $req) {

		if($req->get('deleteBook')) {
			$book = Book::find($req->get('deleteBook'));
			$book and $book->delete();
		}

		$data = [
			"books" => Book::with('author', 'libraries')->get()->toArray()
		];

		return view('list', $data);
	}

	function editBook(Request $req, $id = null) {

		if($req->method() == "POST") {

			// the order matters...

			if(!empty($req->post('id'))) {
				$book = Book::findOrNew($req->post('id'));
			} else {
				$book = Book::make();
			}

			$book->name = $req->post('book-name');

			$book->year = $req->post('book-year');

			if($book->author === null) {
				$author = Author::create();
				$book->author()->associate($author);
			}

			$book->author->name = $req->post('author-name');
			$book->author->birth_date = $req->post('author-birth-date');
			$book->author->genre = $req->post('author-genre');
			$book->author->save();

			if(is_numeric($req->post('select-author'))) {
				$book->author()->associate($req->post('select-author'));
			} else if ($req->post('select-author') == 'new') {
				$book->author()->associate(Author::create());
			}

			$book->save();

			if( $req->has('select-libraries') ) {
				if($req->post('select-libraries') === null) {
					$book->libraries()->detach();
				} else if(is_array($req->post('select-libraries'))) {
					$book->libraries()->sync($req->post('select-libraries'));
				}	
			}

			if (
				!empty($req->post('new-library-name'))
				and !empty($req->post('new-library-address'))
			) {
				Library::create([
					'name' => $req->post('new-library-name'),
					'address' => $req->post('new-library-address')
				]);
			}

		} else {
			$book = Book::findOrNew($id);
		}

		$libraries = $book->libraries;
		$author_list = Author::pluck('name','id')->toArray();
		$library_list = Library::pluck('name','id')->toArray();

	    return view('edit', [
	    	'is_new' => (is_null($id) ? true : false),
	    	'book' => $book,
	    	'author' => $book->author,
	    	'linked_libraries' => $libraries->pluck('id')->toArray(),
	    	'author_list' => $author_list,
	    	'library_list' => $library_list
	    ]);
	}
}
