<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $name = 'Post';
    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];
}
