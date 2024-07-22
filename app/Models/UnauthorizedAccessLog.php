<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnauthorizedAccessLog extends Model
{
    use HasFactory;

    protected $table = 'unauthorized_access';

    protected $fillable = ['user_id', 'ip_address', 'requested_url', 'attempted_at'];
}
