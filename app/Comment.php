<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $name = 'Comment';
    protected $fillable = [
        'name',
        'content',
        'post_id'
    ];
}
