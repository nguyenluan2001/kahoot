<?php

namespace App\Http\Controllers\Main;

use App\Answer;
use App\Favorite;
use App\Http\Controllers\Controller;
use App\Question;
use App\Quizz;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    function ajax_answer()
    {
        $answer=Answer::find(request()->answer);
        if($answer->is_correct=='1')
        {
            if(session('answer'))
            {
                $data=session('answer');
                $data[]=$answer;
                session(['answer'=>$data]);

            }
            else
            {
                $data[]=$answer;
                session(['answer'=>$data]);
            }
        }
        $question=Question::find(request()->question)->answers()->select('id')->whereIsCorrect('1')->get()[0]->id;
        echo $question;
    }
    function ajax_search()
    {
        $keyword=request()->keyword;
        
        $quizzs=Quizz::where('quizz_title','like',"%$keyword%")->get();
        if(empty($quizzs))
        {
            // echo "<h1>Not found for '".$keyword."'</h1>";
            echo "";

        }
        else
        {
            $html="";
            foreach($quizzs as $item)
            {
                $html.=" <div class='item mb-4 shadow'>
                <div class='img'>
                    <a href='' class='d-block w-100'><img src='https://create.kahoot.it/shared/theme/kahoot/img/placeholder-cover-kahoot.png' alt='' class='w-100'></a>
                    
                </div>
                <div class='info'>
                    <div class='info_top'>
                        <div class='title'>
                            <h5><a href='' class='text-decoration-none'>{$item->quizz_title}</a></h5>
                        </div>
                        <div class='action'>
                            <i class='far fa-star text-dark'></i>
                            
                        </div>
                    </div>
                    <div class='info_footer'>
                        <a href='".route('play',$item->id)."' class='btn btn-success font-weight-bold'>Play</a>
                        <a href='".route('edit',[$item->id,$item->questions[0]->id] )."' class='btn btn-primary font-weight-bold'>Edit</a>
                    </div>
                        
                </div>
            
            </div>";
            }
            echo $html;
        }
       
    }
    function ajax_favorite()
    {
        $favorite=new Favorite();
        $favorite->user_id=auth()->user()->id;
        $favorite->quizz_id=request()->quizz;
        $favorite->save();
    }
    function ajax_unfavorite()
    {
        echo request()->quizz;
    }
}
