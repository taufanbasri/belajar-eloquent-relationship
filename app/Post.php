<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'title', 'body'
    ];

    /**
     * Method One to Many Post -> User
     */
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    /**
     * Method Many to Many Post -> Category
     */
    public function categories()
    {
      return $this->belongsToMany(Category::class);
    }
}
