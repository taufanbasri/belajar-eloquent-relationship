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
           $document->adjustments()->attach(auth()->user()->id, [
               'before' => json_encode(array_intersect_key($document->fresh()->toArray(), $document->getDirty())),
               'after' => json_encode($document->getDirty())
           ]);
        });
    }

    public function adjustments()
    {
        return $this->belongsToMany(User::class, 'adjustments')
                ->withTimestamps()
                ->withPivot(['before', 'after'])
                ->latest('pivot_updated_at');
    }
}
