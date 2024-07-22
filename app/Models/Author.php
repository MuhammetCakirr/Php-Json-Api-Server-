<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'author';

    protected $fillable = ['name', 'biography', 'dateofbirth'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
