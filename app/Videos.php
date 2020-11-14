<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    //
    protected $fillable = [
        'video_author','video_path','video_description'
    ];

    
    /**
     * Get the Comments under one Video(A Video can have many Comments)(One to many)
    */
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
