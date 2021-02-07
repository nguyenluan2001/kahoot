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

    #wrapper #content #wp-content #content_2 #list_quizz .item {
        display: flex;
        border: 2px solid white;
        border-radius: 5px;


    }


    #wrapper #content #wp-content #content_2 #list_quizz .item:hover {
        transform: scale(0.99, 0.99);

    }

    #wrapper #content #wp-content #content_2 #list_quizz .item .img {
        width: 20%;
        position: relative;


    }
    #wrapper #content #wp-content #content_2 #list_quizz .item .img .num-ques{
        background-color: #5b5b5b;
        position: absolute;
        right: 5px;
        bottom: 5px;
        color: white;
        border-radius: 2px;
        font-weight: bold;
        padding: 3px 15px;



    }

    #wrapper #content #wp-content #content_2 #list_quizz .item .img img {
        background-color: rgb(204, 204, 204);


    }

    #wrapper #content #wp-content #content_2 .item .info {
        width: 80%;
        background-color: white;
        padding: 10px 25px;
    }

    #wrapper #content #wp-content #content_2 .item .info .info_top {
        display: flex;
        justify-content: space-between;
        height: 70%;
        border-bottom: 1px solid black;
    }

    #wrapper #content #wp-content #content_2 .item .info .info_top .title h5 a {
        color: #333;
    }

    #wrapper #content #wp-content #content_2 .item .info .info_top .title h5 a:hover {
        color: #45a3e5;
    }

    #wrapper #content #wp-content #content_2 .item .info .info_footer {
        padding-top: 5px;
        text-align: right;
    }

    #wrapper #content #wp-content #content_2 #search {
        width: 60%;
        text-align: center;
        position: relative;
        margin: 0px auto;
        margin-bottom: 30px;
    }

    #wrapper #content #wp-content #content_2 #search input {
        width: 100%;
        font-size: 20px;
        padding: 10px 15px;
        border: 0;
    }

    #wrapper #content #wp-content #content_2 #search button {
        position: absolute;
        top: 6px;
        right: 6px;
    }

    #wrapper #content #wp-content #content_2 #list_quizz .item .info .info_top .action i {
        cursor: pointer;
    }
    #wrapper #content #wp-content #content_1{
       padding: 50px 10px 0px 10px;
    
    }
    #wrapper #content #wp-content #content_1 ul a{
        display: flex;
        text-decoration: none;
        padding: 7px 5px;
    }
    #wrapper #content #wp-content #content_1 ul a:hover{
        background-color: hsla(0,0%,43%,.1);
    }
    #wrapper #content #wp-content #content_1 ul a i{
        margin-right: 10px;
        color: #6e6e6e;
        padding-top: 4px;
        box-sizing: border-box;

        
    }
    #wrapper #content #wp-content #content_1 ul a li{
       font-weight: bold;
       color: #6e6e6e;
        
    }
</style>
<script>
    $(document).ready(function() {
        $("#wrapper #content #wp-content #content_2 .point input[type='range']").change(function() {
            var point = $(this).val()
            $(this).prevAll("span.show-point").text(point)
        })
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
        $("#wrapper #content #wp-content #content_2 #search form input").keyup(function() {
            var keyword = $(this).val()
            var data = {
                keyword: keyword
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': 'ajax/search',
                'method': "post",
                'data': data,
                success: function(data) {
                    if (data != "") {

                        $("#wrapper #content #wp-content #content_2 #list_quizz").html(data)
                    } else {
                        var notFound = "<h1 class='text-center'>Not found for \"" + keyword + "\"</h1>"
                        $("#wrapper #content #wp-content #content_2 #list_quizz").html(notFound)
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status)
                    alert(thrownError)
                }

            })
        })
        $("#wrapper #content #wp-content #content_2 #list_quizz .item .info .info_top .action i[class='far fa-star']").click(function() {
            alert(1)
            var quizz = $(this).data('quizz')
            var data = {
                quizz: quizz
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': 'ajax/favorite',
                'method': 'post',
                'data': data,
                success: function(data) {
                    $("#wrapper #content #wp-content #content_2 #list_quizz .item .info .info_top .action i[class='far fa-star'][data-quizz='" + quizz + "']").removeClass('far fa-star').addClass('class', 'fas fa-star').css('color', '#ffa602')
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status)
                    alert(thrownError)
                }
            })
        })
        $("#wrapper #content #wp-content #content_2 #list_quizz .item .info .info_top .action i[class='fas fa-star']").click(function() {
            var quizz = $(this).data('quizz');
            var data = {
                quizz: quizz
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': 'ajax/unfavorite',
                'method': 'post',
                'data': data,
                success: function(data) {
                    $("#wrapper #content #wp-content #content_2 #list_quizz .item .info .info_top .action i[class='fas fa-star'][data-quizz='" + quizz + "']").attr('class', 'far fa-star').css('color', '#212529')
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status)
                    alert(thrownError)
                }

            })
        })

    })
</script>
<div id="wp-content">
    <div id="content_1">
        <ul class="list-unstyled">
            <a href="">
                <i class="far fa-user"></i>
                <li>My Kahoots</li>
            </a>
            <a href="">
                <i class="far fa-star"></i>
                <li>Favorites</li>
            </a>
            <a href="">
                <i class="far fa-edit"></i>
                <li>My drafts</li>
            </a>
        </ul>
    </div>
    <div id="content_2" class="px-4">
        <div id="search">
            <form action="">
                <input type="text" name="key_word" placeholder="Search...">
                <button class="btn"><i class="fas fa-search"></i></button>

            </form>

        </div>
        <div id="list_quizz" class="w-100">
            @foreach($list_quizzs->quizzs as $item)
            <div class="item mb-4 shadow">
                <div class="img">
                    <a href="" class="d-block w-100"><img src="https://create.kahoot.it/shared/theme/kahoot/img/placeholder-cover-kahoot.png" alt="" class="w-100"></a>
                    <div class="num-ques">{{$item->questions->count()}} Questions</div>

                </div>
                <div class="info">
                    <div class="info_top">
                        <div class="title">
                            <h5><a href="{{route('detail',$item->slug)}}" class="text-decoration-none">{{$item->quizz_title}}</a></h5>
                        </div>
                        <div class="action">
                            @if($item->id==$item->favorites->first()['quizz_id'])
                            <i id="favorite" class="fas fa-star" data-quizz="{{$item->id}}" style="color: #ffa602;"></i>
                            @else
                            <i id="unfavorite" class="far fa-star" data-quizz="{{$item->id}}"></i>

                            @endif
                        </div>
                    </div>
                    <div class="info_footer">
                        <a href="{{route('play',$item->id)}}" class="btn btn-success font-weight-bold">Play</a>
                        <a href="{{route('edit',[$item->id,$item->questions[0]->id] )}}" class="btn btn-primary font-weight-bold">Edit</a>
                    </div>

                </div>

            </div>
            @endforeach

        </div>
    </div>


</div>
@endsection