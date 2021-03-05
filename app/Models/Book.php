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

        $details = [
            'title' => $this->name,
            'author' => $this->author->name,
            'author_id' => $this->author->id,
            'genre' => $this->author->genre,
            'year' => $this->year,
            'libraries' => []
        ];

        if($this->id) {
            $details['id'] = $this->id;
        }

        foreach ($this->libraries as $library) 
        {
            array_push($details['libraries'],[
                'id' => $library->id,
                'name' => $library->name,
                'address' => $library->address
            ]);
        }

        return $details;
    }

    public function setDetailsAttribute($val)
    {
        $book = $this;

        if(isset($val['id'])) {
            $book->id = $val['id'];
        }
        $book->name = $val['title'];
        $book->year = $val['year'];

        $author = new Author([
            "name" => $val['author'],
            "genre" => $val['genre']
        ]);

        if($val['author_id']) {
            $author->id = $val['author_id'];
        }

        $book->author()->associate($author);
        $book->save();

        if(isset($val['libraries']) and is_array($val['libraries'])) 
        {
            foreach ($val['libraries'] as $library) 
            {
                $library->id = $val['id'];
                $library->name = $val['name'];
                $library->address = $val['address'];
            }
        }

    }

}
