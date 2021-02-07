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
                    <h3 class="text-center">Register</h3>
                    <form action="{{route('register')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="fullname">Fullname</label>
                            <input type="text" id="fullname" name="fullname" class="form-control">
                            @error('fullname')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-success" value="Register">
                        </div>
                        <div class="form-group text-center">
                            <a href="{{route('loginView')}}">Login</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>