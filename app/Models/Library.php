<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Book;
use App\Models\Author;

class Library extends Model
{
    public $timestamps = false;

    use HasFactory;

    protected $fillable = ['name', 'address'];

    public function books() 
    {
    	return $this->belongsToMany(Book::class);
    }

    public function authors() 
    {
    	return $this->belongsToMany(Author::class);
    }

}
