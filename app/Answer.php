<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $guarded=[];
    function question()
    {
        return $this->belongsTo(Question::class);
    }
}
