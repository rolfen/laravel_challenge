<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['name', 'year'];

    public $timestamps = false;

    protected $hidden = ['deleted_at']; // why isn't Laravel doing this for me?

    public function author()
    {
        return $this->belongsTo(Author::class);
    }


    public function libraries()
    {
        return $this->belongsToMany(Library::class);
    }


}
