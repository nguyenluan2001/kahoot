<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Question;
use App\Quiz;
use App\Quizz;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class QuizController extends Controller
{
    function store()
    {
        // session_destroy();
        $user=User::find(auth()->user()->id);
        $data=request()->all();
        $data['slug']=Str::slug($data['quizz_title']);
        $quiz = $user->quizzs()->create($data);
        foreach ($_SESSION['questions'] as $item) {
            $question = $quiz->questions()->create([
                'question'=>$item['question'],
                'point'=>$item['point']
            ]);
            $answers = array();
            foreach ($item['answers'] as $key => $value) {
                if ($key == $item['correct_answer']) {
                    $answers[$key] = [
                        'answer' => $value,
                        'is_correct' => '1'
                    ];
                } else {
                    $answers[$key] = [
                        'answer' => $value,
                        'is_correct' => '0'
                    ];
                }
            }
            $question->answers()->createMany($answers);
        }
        session_destroy();
        return redirect()->route('home');
    }
    function detail($slug)
    {
        $quizz=Quizz::whereSlug($slug)->get()[0];
        return view('detail',compact('quizz'));
    }
    function edit(Quizz $quizz,$question)
    {
        // $quizz->load('questions.answers');
        // return view('edit',compact('quizz'));

        $question=$quizz->questions()->where('id',$question)->get()[0];
       return view('edit',compact('question'));
    }
    function update(Quizz $quizz,$question)
    {
        $question=$quizz->questions()->where('id',$question)->get()[0];
        $question->question=request()->question;
        $question->point=request()->point;
        foreach($question->answers as $key=>$item)
        {
            if($key=='0')
            {
                $item->answer=request()->answer[1];
                if($item->is_correct=='1')
                {
                    $item->is_correct='0';
                }
                if(request()->correct_answer=='1')
                {
                    $item->is_correct='1';

                }
            }
            else if($key=='1')
            {
                $item->answer=request()->answer[2];
                if($item->is_correct=='1')
                {
                    $item->is_correct='0';
                }
                if(request()->correct_answer=='2')
                {
                    $item->is_correct='1';
                }
            }
            else if($key=='2')
            {
                $item->answer=request()->answer[3];
                if($item->is_correct=='1')
                {
                    $item->is_correct='0';
                }
                if(request()->correct_answer=='3')
                {
                    $item->is_correct='1';
                }
            }
            else if($key=='3')
            {
                $item->answer=request()->answer[4];
                if($item->is_correct=='1')
                {
                    $item->is_correct='0';
                }
                if(request()->correct_answer=='4')
                {
                    $item->is_correct='1';
                }
            }
            
        }
        $question->push();
        // return $question;
        // return request()->all();
        return back()->with('editSuccess','Edit Successfully');
    }
    function updateQuizz(Quizz $quizz)
    {
        $quizz->quizz_title=request()->quizz_title;
        $quizz->quizz_description=request()->quizz_description;
        $quizz->save();
        return redirect()->route('home');
    }
}
