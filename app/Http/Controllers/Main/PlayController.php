<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Question;
use App\Quizz;
use Illuminate\Http\Request;

class PlayController extends Controller
{
    function play( $quizz)
    {
        $questions=Question::whereQuizzId($quizz)->Simplepaginate(1);
        // return $questions;
        return view('play',compact('questions'));
    }
    function result()
    {
        // session()->forget('answer');
        return view('result') ;
    }
}
