<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class QuestionController extends Controller
{
    function storeTemp()
    {
        $questions=request()->validate([
            'question'=>'required',
            'point'=>'required',
            'answer[*]'=>'required',
            'correct_answer'=>'required'
        ]);
        $questions['answers']=request()->answer;
        $_SESSION['questions'][]=$questions;
        return back()->with('questions',$_SESSION['questions']);
    }
}
