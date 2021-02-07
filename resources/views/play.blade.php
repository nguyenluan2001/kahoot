<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('resources/bootstrap/css/bootstrap.min.css')}}">
    <script src="{{asset('resources/js/jquery.js')}}"></script>
    <script src="{{asset('resources/js/jquery-3.4.1.slim.min.js')}}"></script>
    <script src="{{asset('resources/js/jquery.moreline.min.js')}}"></script>
    <script src="{{asset('resources/bootstrap/js/bootstrap.min.js')}}"></script>
    <base href="{{config('app.url')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
            margin: 0px auto;
            padding: 0;
        }

        #wp_play {
            width: 100%;
            height: 100%;
            background-color: #f2f2f2;
        }

        #wp_play #question {
            height: 20%;
            background-color: #fff;
            text-align: center;
            font-size: 50px;
            padding-top: 30px;
            box-sizing: border-box;
        }

        #wp_play #answer {

            padding: 0px 10px;
            height: 80%;
        }

        #wp_play #answer .wp_item {
            width: 50%;
            height: 20%;
            margin-bottom: 10px;
            cursor: pointer;
            vertical-align: bottom;
        }

        #wp_play #answer .wp_item:nth-child(odd) {
            padding-right: 10px;
            box-sizing: border-box;
        }

        #wp_play #answer .item {
            margin-bottom: 5px;
            height: 100%;
            border-radius: 5px;
            padding-left: 10px;
            padding-top: 30px;
        }

        .float-left {
            float: left;
        }

        .clearfix {
            clear: all;
        }

        #wp_play #answer .wp_item:nth-child(1) .item {
            background-color: rgb(208, 25, 55);
        }

        #wp_play #answer .wp_item:nth-child(2) .item {
            background-color: rgb(18, 96, 190);
        }

        #wp_play #answer .wp_item:nth-child(3) .item {
            background-color: rgb(199, 146, 0);
        }

        #wp_play #answer .wp_item:nth-child(4) .item {
            background-color: rgb(35, 126, 11);
        }

        #wp_play #answer .wp_item .item p {
            display: block;
            font-size: 25px;
            color: white;
            font-weight: bold;

        }

        #wp_play #answer .wp_item .item {
            display: flex;
            justify-content: space-between;
            padding-right: 30px;
        }

        #wp_play #answer .wp_item .item i {
            font-size: 40px;
            display: none;
        }

        #wp_play .alert {
            display: none;
        }
        #result{
            display: none;
        }
    </style>
    <script>
        $(document).ready(function() {

            $("#wp_play #answer .wp_item").one('click', function() {
                if ($("#wp_play #correct").is(":visible") || $("#wp_play #wrong").is(":visible")) {
                    return false;
                } else {
                    var answer = $(this).data('answer')
                    var question = $(this).data('question')
                    var data = {
                        question: question,
                        answer: answer
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        'url': 'ajax/answer',
                        'method': 'post',
                        'data': data,
                        success: function(data) {

                            $("#wp-play #answer .wp_answer").css('cursor', 'context-menu')
                            $("#wp_play #answer .wp_item .item").css('background', 'rgb(255, 51, 85)')
                            $("#wp_play #answer .wp_item .item i").css({
                                'display': 'block',
                                'color': 'white'
                            })
                            $("#result").show()
                            $("#wp_play #answer #answer_" + data).children('.item').css('background', 'rgb(102, 191, 57)')
                            if (answer == data) {
                                $('#wp_play #correct').slideDown(500)
                            } else {

                                $('#wp_play #wrong').slideDown(500)
                            }

                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status)
                            alert(thrownError)
                        }

                    })
                    return false;
                }



            })

        })
    </script>
    <div id="wp_play">
        <div id="question">
            <p>{{$questions[0]->question}}</p>

        </div>
        <div id="correct" class="alert alert-success text-center">
            <h1>Correct Answer</h1>
            <h1>+{{$questions[0]->point}} points</h1>
        </div>
        <div id="wrong" class="alert alert-danger text-center">
            <h1>Wrong Answer</h1>
            <h1>+0 points</h1>
        </div>
        <div id="answer">
            @foreach($questions[0]->answers as $item)
            <div class="wp_item float-left" id="answer_{{$item->id}}" data-answer="{{$item->id}}" data-question="{{$questions[0]->id}}">
                @if($item->is_correct=='1')

                <div class="item">
                    <p>{{$item->answer}}</p>
                    <i class="fas fa-check"></i>
                </div>
                @else

                <div class="item ">
                    <p>{{$item->answer}}</p>
                    <i class="fas fa-times"></i>
                </div>
                @endif
            </div>
            @endforeach
            <div class="clearfix"></div>

            {{$questions->links()}}
            <a href="{{route('home')}}" class="btn btn-info">Home</a>
            @if(isset($_GET['page']))

            @if($_GET['page']=='2')

            <a href="{{route('play.result')}}" id="result" class="btn btn-info">Result</a>
            @endif
            @endif
        </div>
    </div>
</body>

</html>