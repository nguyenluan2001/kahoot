<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <style>
        html,
        body {
            height: 100%;
        }
    </style>
    <div id="wrapper" class="w-100 h-100 bg-info pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 bg-white mx-auto border rounded">
                    <h3 class="text-center">Login</h3>
                    @if(session('loginFail'))
                    <div class="alert alert-danger" id="loginFail">
                        <button class="close" data-dismiss="alert" data-target="#loginFail">
                            <span>&times;</span>
                        </button>
                        {{session('loginFail')}}
                    </div>
                    @endif
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-success" value="Login">
                        </div>
                        <div class="form-group text-center">
                            <a href="">Forget password?</a>
                            <span>|</span>
                            <a href="{{route('registerView')}}">Register</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>