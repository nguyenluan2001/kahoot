<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizz extends Model
{
    protected $guarded=[];
    function questions()
    {
        return $this->hasMany(Question::class);
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function favorites()
    {
        return $this->hasMany(Favorite::class);

    }
}
