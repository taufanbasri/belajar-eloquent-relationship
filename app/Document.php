<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($document){
           $document->adjustments()->attach(auth()->user()->id);
        });
    }

    public function adjustments()
    {
        return $this->belongsToMany(User::class, 'adjustments')
                ->withTimestamps()
                ->latest('pivot_updated_at');
    }
}
