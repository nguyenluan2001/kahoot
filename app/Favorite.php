<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    function users()
    {
        return $this->hasMany(User::class);
    }
    function quizzs()
    {
        return $this->hasMany(Quizz::class);
    }
}
