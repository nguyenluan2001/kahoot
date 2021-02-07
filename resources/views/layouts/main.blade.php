<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{config('app.url')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="{{asset('resources/bootstrap/css/bootstrap.min.css')}}">
    <script src="{{asset('resources/js/jquery.js')}}"></script>
    <script src="{{asset('resources/js/jquery-3.4.1.slim.min.js')}}"></script>
    <script src="{{asset('resources/js/jquery.moreline.min.js')}}"></script>
    <script src="{{asset('resources/bootstrap/js/bootstrap.min.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <script>
        $(document).ready(function() {
            $("#wrapper #header #user p").click(function() {
                $(this).next('ul#action').slideToggle()
            })
        })
    </script>
    <style>
        #wrapper #header {
            background-color: rgb(70, 23, 143);
            color: white;
         }

        #wrapper #header .col-md-6 {
            box-sizing: border-box;
            padding-top: 10px;
        }

        #wrapper #header .col-md-4 {
            box-sizing: border-box;
            padding-top: 10px;
        }

        #wrapper #header #user {
            position: relative;
        }

        #wrapper #header #user p {
            cursor: pointer;
        }

        #wrapper #header #user ul#action {
            background-color: white;
            display: none;
            position: absolute;
            top: 100%;
            z-index: 5;
        }

        #wrapper #header #user ul#action li:hover {
            background-color: #78E532;
        }

        #wrapper #header .col-md-4 a#create_btn {
            border: solid 1px black;
            background-color: rgb(255, 255, 255);
            color: black;
            height: 80%;
            padding: 0px 15px;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;

        }

        #wrapper #header .col-md-4 a#create_btn:hover {
            background-color: gainsboro;

        }
    </style>
    <div id="wrapper">
        <div id="header" class="border">
            <div class="container">
                <div class="row align-middle">
                    <div class="col-md-2">
                        <a href="{{route('home')}}">
                            <h2>Kahoot!</h2>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="mr-3">Home</a>
                        <a href="" class="mr-3">About us</a>
                        <a href="">Contact</a>

                    </div>
                    <div class="col-md-4 d-flex">
                        <a href="{{url('create')}}" class="mr-3" id="create_btn">Create</a>
                        @auth
                        <div id="user" class="h-100">
                            <p>{{auth()->user()->fullname}}</p>
                            <ul class="list-unstyled border w-100" id="action">
                                <a href="" class="text-decoration-none">
                                    <li class="py-2 pl-2 text-dark">Profile</li>
                                </a>
                                <a href="{{route('logout')}}" class="text-decoration-none">
                                    <li class="py-2 pl-2 text-dark">Logout</li>
                                </a>
                            </ul>
                        </div>
                        @endauth
                        @guest
                        <a href="{{route('loginView')}}" class="byn btn-success">Login</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            @yield('content')
        </div>
        <div id="footer"></div>
    </div>
</body>

</html>