<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBook extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'table_userbook';

    protected $fillable = ['user_id', 'book_id', 'dateoftake', 'dateofdelivery', 'status_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
