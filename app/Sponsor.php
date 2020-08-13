<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Sponsor extends Model
{
    protected $fillable = ['name', 'description', 'zone', 'image', 'alternative', 'link'];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::deleting(function($sponsor){
            Storage::delete($sponsor->image);
        });
    }
}