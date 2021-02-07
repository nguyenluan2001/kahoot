@extends('layouts/main')
@section('content')
<style>
    #wrapper #content #wp-content {
        display: flex;
    }

    #wrapper #content #wp-content #content_1 {
        width: 30%;
        height: 100%;

    }

    #wrapper #content #wp-content #content_1 #image {
        background-color: rgb(204, 204, 204);

    }

    #wrapper #content #wp-content #content_1 #info {
        padding: 20px 15px;

    }

    #wrapper #content #wp-content #content_1 #statistic {
        display: flex;
        align-content: space-between;
        width: 100%;
        margin-bottom: 10px;

    }

    #wrapper #content #wp-content #content_1 #action {
        display: flex;
        align-content: space-between;

    }

    #wrapper #content #wp-content #content_1 #other-action {
        padding-top: 4px;
        box-sizing: border-box;
        font-size: 22px;
    }


    #wrapper #content #wp-content #content_2 {
        width: 70%;
        background-color: rgb(242, 242, 242);
        padding: 30px 20px 0px 20px;
        min-height: 700px;

    }

    #wrapper #content #wp-content #content_2 #top {
        display: flex;

    }

    #wrapper #content #wp-content #content_2 #top #show_answer {
        margin-left: auto;
        cursor: pointer;

    }

    #wrapper #content #wp-content #content_2 #list_questions .item {
        min-height: 50px;
        background-color: white;
        margin-bottom: 10px;
        cursor: pointer;
        border-radius: 5px;
    }
    #wrapper #content #wp-content #content_2 #list_questions .item .wp_question{
       display: flex;
    }

    #wrapper #content #wp-content #content_2 #list_questions .item .body {
        width: 80%;
        padding: 10px 0px 0px 5px;

    }

    #wrapper #content #wp-content #content_2 #list_questions .item .image {
        width: 20%;
        background-color: rgb(204, 204, 204);
    }
    #wrapper #content #wp-content #content_2 #list_questions .item .wp_answer {
      display: none;
    }
    #wrapper #content #wp-content #content_2 #list_questions .item .wp_answer .answer{
        border-top: 1px solid gainsboro;
        padding: 10px 20px 10px 10px;
        display: flex;
    }
   
    #wrapper #content #wp-content #content_2 #list_questions .item .wp_answer .answer i{
       margin-left: auto;
       padding-top: 10px;
    }
</style>
<script>
    $(document).ready(function() {
        $("#wrapper #content #wp-content #content_2 #list_questions .item").click(function(){
            $(this).children(".wp_answer").slideToggle()
        })
        $(" #wrapper #content #wp-content #content_2 #top #show_answer ").click(function(){
            $(".wp_answer").slideToggle()
        })

    })
</script>
<div id="wp-content">
    <div id="content_1">
        <div id="image">
            <img src="https://create.kahoot.it/shared/theme/kahoot/img/placeholder-cover-kahoot.png" alt="" class="w-100">
        </div>
        <div id="info">
            <div id="quizz_title">
                <h2>{{$quizz->quizz_title}}</h2>

            </div>
            <div id="statistic">
                <div id="plays" class="mr-4"><strong>0</strong> plays</div>
                <div id="favorite" class="mr-4"><strong>0</strong> favorite</div>
                <div id="players" class="mr-4"><strong>0</strong> players</div>
            </div>
            <div id="action">
                <div id="button" style="width:80%;">
                    <a href="" class="btn btn-success">Play</a>
                    <a href="" class="btn btn-primary">Edit</a>
                </div>
                <div id="other-action">
                    <a href="" class="pr-2"><i class="far fa-star"></i></a>
                    <a href=""><i class="fas fa-ellipsis-v"></i></a>

                </div>


            </div>



        </div>
    </div>
    <div id="content_2">
        <div id="top">
            <h4>Questions ({{$quizz->questions->count()}})</h4>
            <h5 id="show_answer">Show Answer</h5>
        </div>
        <div id="list_questions">
            @foreach($quizz->questions as $key=>$item)
            <div class="item">
                <div class="wp_question">
                    <div class="body">
                        <p>{{$key+1}} - Quiz</p>
                        <strong> {{$item->question}}</strong>

                    </div>
                    <div class="image">
                        <img class="w-100" src="https://create.kahoot.it/shared/theme/kahoot/img/placeholder-cover-kahoot.png" alt="" class="w-100">
                    </div>
                </div>

                <div class="wp_answer">
                    @foreach($item->answers as $value)
                    <div class="answer">
                        <p>{{$value->answer}}</p>
                        
                        @if($value->is_correct=='1')
                        <i class="fas fa-check text-success"></i>
                        @else
                        <i class="fas fa-times text-danger"></i>
                        @endif

                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

    </div>

</div>
@endsection