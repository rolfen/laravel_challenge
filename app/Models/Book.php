<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Author;
use App\Models\Library;


class Book extends Model
{
    public $timestamps = false;

    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['name', 'year'];

    protected $hidden = ['deleted_at']; 

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function libraries()
    {
        return $this->belongsToMany(Library::class);
    }

    public function getDetailsAttribute() 
    {
        $book = $this;
        $details = [
            'title' => $book->name,
            'author' => $book->author->name,
            'genre' => $book->author->genre,
            'year' => $book->year
        ];

        foreach ($book->libraries as $library) 
        {
            array_push($details['libraries'],[
                'id' => $library->id,
                'name' => $library->name,
                'address' => $library->address
            ]);
        }
        
        return $details;
    }


}
