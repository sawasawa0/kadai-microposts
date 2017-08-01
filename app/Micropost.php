<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['id', 'content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //お気に入りされた
    public function favored()
    {
        return $this->belongsToMany(User::class, 'favorites', 'micropost_id', 'user_id')->withTimestamps();
    }
    
}
