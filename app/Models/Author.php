<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $timestamps = false;

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
