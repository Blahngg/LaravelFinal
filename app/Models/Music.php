<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $fillable = [
        'title',
        'artist',
        'image',
        'audio',
        'listens'
    ];

    public function ratings(){
        return $this->hasMany(
            Rating::class,
            'music_id',
            'id');
    }

    public function genres(){
        return $this->belongsToMany(Genre::class);
    }

    public function likedUsers(){
        return $this->belongsToMany(Music::class,'likes')
            ->withTimestamps();
    }

    public function playlists(){
        return $this->belongsToMany(Playlist::class)
            ->withTimestamps();
    }
}
