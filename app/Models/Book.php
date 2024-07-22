<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'book';

    protected $fillable = ['title', 'description', 'published_date', 'author_id', 'deleted_at'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function userBooks()
    {
        return $this->hasMany(UserBook::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre');
    }
}
