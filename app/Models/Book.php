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

        if(isset($val['author_id'])) {
            $author = Author::findOrNew($val['author_id']);
        } else {
            $author = Author::make();           
        }

        $author->name = $val['author'];
        $author->genre = $val['genre'];

        $book->author()->associate($author);

        if(isset($val['libraries']) and is_array($val['libraries'])) 
        {
            $libraries = [];
            foreach ($val['libraries'] as $library_details )
            {
                if(isset($library_details['id'])) {
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

                array_push($libraries, $library);
            }
            $book->libraries()->sync($libraries);
        }
    }
}
