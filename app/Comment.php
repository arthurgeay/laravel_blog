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

    public function getCreatedAtAttribute($value)
    {
        return Carbon::instance(new \DateTime($value))->diffForHumans();
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
