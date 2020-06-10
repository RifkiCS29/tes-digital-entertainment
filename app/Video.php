<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    protected $guarded = [];
    
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value); 
    }
}
