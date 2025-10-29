<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'rating', 
        'music_id', 
        'user_id', 
        'review'
    ];

    public function music() {
        return $this->belongsTo(
            Music::class,
            'music_id',
            'id');
    }
    public function user() {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id');
    }
}
