<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $guarded=[];
    function answers()
    {
        return $this->hasMany(Answer::class);
    }
    function quizz()
    {
        return $this->belongsTo(Quizz::class);
    }
}
