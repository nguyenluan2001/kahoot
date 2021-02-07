@extends('layouts/main')
@section('content')
<style>
    #wrapper #content #wp-content {
        display: flex;
        padding-left: 10px;
    }

    #wrapper #content #wp-content #content_1 {
        width: 20%;

    }

    #wrapper #content #wp-content #content_2 {
        width: 80%;
        background-color: rgb(242, 242, 242);
        padding-top: 30px;

    }

    #wrapper #content #wp-content #content_2 form {
        width: 90%;
        margin: 0px auto;

    }

    #wrapper #content #wp-content #content_2 .question {
        margin-bottom: 50px;
    }

    #wrapper #content #wp-content #content_2 .question input {
        width: 100%;
        height: 100px;
        font-size: 30px;
        border: none;
        margin: 0px auto;
        display: block;
        text-align: center;
        border-radius: 5px;
        box-shadow: 0px 6px 20px 0px;

    }


    #wrapper #content #wp-content #content_2 .question input:focus {
        outline: none;
    }

    #wrapper #content #wp-content #content_2 .answer {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
    }

    #wrapper #content #wp-content #content_2 .answer .item {
        width: 50%;
        padding-bottom: 6px;
        border-radius: 6px;
        height: 100px;
        position: relative;
    }

    #wrapper #content #wp-content #content_2 .answer .item:nth-child(odd) {
        padding-right: 3px;
    }

    #wrapper #content #wp-content #content_2 .answer .item:nth-child(even) {
        padding-left: 3px;
    }

    #wrapper #content #wp-content #content_2 .answer .item input {
        width: 100%;
        height: 100%;
        font-size: 20px;
        border-radius: 5px;
        border: none;
        padding-left: 20px;
    }

    #wrapper #content #wp-content #content_2 .answer .item input:focus {
        outline: none;
    }

    #wrapper #content #wp-content #content_2 .answer .item .wp-item {
        background-color: white;
        height: 100%;
        border-radius: 5px;
    }

    #wrapper #content #wp-content #content_2 .answer .item input[type="radio"] {
        height: 50%;
        width: 5%;
        position: absolute;
        top: 20px;
        right: 20px;
        font-weight: bold;

    }

    #wrapper #content #wp-content #content_2 .point {
        display: flex;
    }

    #wrapper #content #wp-content #content_2 .answer .item:nth-child(1) .wp-item input[type='text'] {
        background-color: rgb(208, 25, 55);
        color: white;
    }

    #wrapper #content #wp-content #content_2 .answer .item:nth-child(2) .wp-item input[type='text'] {
        background-color: rgb(18, 96, 190);
        color: white;
    }

    #wrapper #content #wp-content #content_2 .answer .item:nth-child(3) .wp-item input[type='text'] {
        background-color: rgb(199, 146, 0);
        color: white;
    }

    #wrapper #content #wp-content #content_2 .answer .item:nth-child(4) .wp-item input[type='text'] {
        background-color: rgb(35, 126, 11);
        color: white;
    }
</style>
<script>
    $(document).ready(function() {
        $("#wrapper #content #wp-content #content_2 .point input[type='range']").change(function() {
            var point = $(this).val()
            $(this).prevAll("span.show-point").text(point)
        })
        $("#wrapper #content #wp-content #content_2 .answer .answer .item:eq(0)").children('.wp-item').css('background', 'red')


        $("#wrapper #content #wp-content #content_2 .answer .item input[type='text']").change(function() {
            var text = $(this).val()
            if (text != "") {
                var color = $(this).data('color')
                $(this).next("input[type='radio']").show()
                $(this).parent().css('background', color)
                $(this).css('background', color)
                $(this).css('color', 'white')
            } else {
                $(this).next("input[type='radio']").hide()
                $(this).parent().css('background', "white")
                $(this).css('background', "white")
                $(this).css('color', 'black')
            }


        });
        $('#wrapper #content #wp-content #content_1 #done').click(function() {
            $(this).next('#create_quiz').show()

        });

    })
</script>
<div id="wp-content">
    <div id="content_1">
        <h3>Your Questions</h3>
        <ul>
            @foreach($question->quizz->questions as $key=>$item)
            <li> <a href="{{route('edit',[$question->quizz->id,$item->id])}}">{{$item->question}}</a></li>
            @endforeach

        </ul>
        <button type="button" id="done" data-toggle="modal" data-target="#create_quiz" class="btn btn-success">Done</button>
        <div class="modal fade" id="create_quiz" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Edit Quizz</h5>
                        <button class="close" data-dismiss="modal" data-target="#create_quiz">
                            <span>&times;</span>
                        </button>

                    </div>
                    <div class="modal-body">
                        <form action="{{route('updateQuizz',$question->quizz->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="quiz_title" class="font-weight-bold">Title</label>
                                <input type="text" id="quiz_title" class="form-control" name="quizz_title" placeholder="Enter kahoot title..." value="{{$question->quizz->quizz_title}}">
                            </div>
                            <div class="form-group">
                                <label for="quiz_description" class="font-weight-bold">Description</label>
                                <textarea name="quizz_description" class="form-control" id="quizz_description" cols="30" rows="10">{{$question->quizz->quizz_description}}</textarea>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-light" data-dismiss="modal" data-target="#create_quiz">Cancel</button>
                                <button class="btn btn-success">Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="content_2">
        @if(session('editSuccess'))
        <div class="alert alert-success mx-auto" style="width: 90%;">
            <button class="close" data-dismiss="alert">
                <span>&times;</span></button>
            {{session('editSuccess')}}
        </div>
        @endif
        <form action="{{route('update',[$question->quizz->id,$question->id])}}" method="post">
            @csrf
            <div class="question">
                <input type="text" placeholder="Click to start typing your question" name="question" required-autocomplete="question" value="{{$question->question}}">
            </div>
            <div class="point">
                <strong>Point: </strong><span class="show-point">{{$question->point}}</span>
                <input type="range" class="custom-range ml-3" min="0" max="100" name="point" value="{{$question->point}}">
            </div>
            <div class="answer">
                <div class="item">
                    <div class="wp-item">
                        <input type="text" name="answer[1]" placeholder="Add answer 1" data-color="rgb(208, 25, 55)" value="{{$question->answers[0]->answer}}">
                        <input type="radio" name="correct_answer" class="bounce-4" value="1" @if($question->answers[0]->is_correct=='1') checked='checked' @endif>
                    </div>
                </div>
                <div class="item">
                    <div class="wp-item">
                        <input type="text" name="answer[2]" placeholder="Add answer 2" data-color="rgb(18, 96, 190)" value="{{$question->answers[1]->answer}}">
                        <input type="radio" name="correct_answer" value="2" @if($question->answers[1]->is_correct=='1') checked='checked' @endif>
                    </div>
                </div>

                <div class="item">
                    <div class="wp-item">
                        <input type="text" name="answer[3]" placeholder="Add answer 3" data-color="rgb(199, 146, 0)" value="{{$question->answers[2]->answer}}">
                        <input type="radio" name="correct_answer" value="3" @if($question->answers[2]->is_correct=='1') checked='checked' @endif>
                    </div>
                </div>
                <div class="item">
                    <div class="wp-item">
                        <input type="text" name="answer[4]" placeholder="Add answer 4" data-color="rgb(35, 126, 11)" value="{{$question->answers[3]->answer}}">
                        <input type="radio" name="correct_answer" value="4" @if($question->answers[3]->is_correct=='1') checked='checked' @endif>
                    </div>
                </div>
            </div>
            <div class="w-100 text-center">
                <input type="submit" class="btn btn-outline-success" value="Edit">

            </div>
        </form>

    </div>

</div>
@endsection