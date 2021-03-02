<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Book;
use App\Models\Library;


class Author extends Model
{
    public $timestamps = false;

    use HasFactory;

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function libraries()
    {
        return $this->belongsToMany(Library::class);
    }

    protected $fillable = ['name', 'birth_date', 'genre'];


}
