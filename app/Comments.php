<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    protected $fillable = [
        'videos_id',
        'name','email', 
        'age', 'rating','comment'
    ];

    // Comments belongs to one Video
    public function video()
    {
        return $this->belongsTo(Videos::class);
    }
}
