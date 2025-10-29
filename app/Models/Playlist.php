<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Playlist extends Model
{
    protected $fillable = [
        'user_id',
        'image',
        'title',
        'description'
    ];

    public function user(){
        return $this->belongsTo(
            User::class, 
            'user_id', 
            'id');
    }

    public function musics(){
        return $this->belongsToMany(Music::class)
            ->withTimestamps();
    }
}
