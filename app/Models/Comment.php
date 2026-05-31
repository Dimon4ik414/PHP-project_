<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'comment', 'post_id', 'approved', 'role_request_id', 'user_id',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

