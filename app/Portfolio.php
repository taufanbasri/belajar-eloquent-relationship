<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'user_id', 'title', 'body'
    ];

    /**
     * Get all of the Comment's models.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Many to Many Polimorphic
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
