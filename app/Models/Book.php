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

    public function getDetails() 
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

    public function saveDetails($val)
    {

        $book = $this;

        if(isset($val['id'])) {
            $book->id = $val['id'];
        }
        $book->name = $val['title'];
        $book->year = $val['year'];

        if(isset($val['author_id']) and !is_null($val['author_id'])) {
            $author = Author::updateOrCreate([
                'id' => $val['author_id']
            ],[
                'name' => $val['author'],
                'genre' => $val['genre']
            ]);
        } else {
            $author = Author::create([
                'name' => $val['author'],
                'genre' => $val['genre']
            ]);           
        }

        $book->author()->associate($author);

        $book->save();

        if(isset($val['libraries']) and is_array($val['libraries'])) 
        {
            $library_ids = [];
            foreach ($val['libraries'] as $library_details )
            {
                if(isset($library_details['id']) and !is_null($library_details['id'])) {
                    $library = Library::updateOrCreate([
                        'id' => $library_details['id']
                    ], [
                        'name' => $library_details['name'],
                        'address' => $library_details['address']
                    ]);
                } else {
                    $library = Library::create([
                        'name' => $library_details['name'],
                        'address' => $library_details['address']
                    ]);
                }
                array_push($library_ids, $library->id);
            }
            $book->libraries()->sync($library_ids);
        }
    }
}
