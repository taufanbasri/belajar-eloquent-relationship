<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'slug', 'name'
    ];

    /**
     * Method Many to Many Category -> Post
     */
    public function posts()
    {
      return $this->belongsToMany(Post::class);
    }
}
