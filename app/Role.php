<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function posts()
    {
      return $this->hasManyThrough(Post::class, User::class, 'role_id');

      // hasManyThrough(Post::class -> model yang dibutuhkan datanya, User::class -> model penghubung, 'role_id' -> foreign key yang ada di model penghubung, 'user_id' -> foreign key yang terhubung ke model post, 'id', 'id' -> 2 parameter terakhir adalah primary key model jika tidak menggunakan primary key standar (optional) )
    }
}
