<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $name = 'Comment';
    protected $fillable = [
        'name',
        'content',
        'post_id',
        'reports',
        'parent_id'
    ];

    protected $with = ['children'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

}
