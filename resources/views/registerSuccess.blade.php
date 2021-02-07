
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
                <div class="col-md-6 bg-white mx-auto border rounded py-2">
                    <h3 class="text-center">Register Success</h3>
                    <img class="w-50 mx-auto d-block mb-3" src="{{asset('resources/images/green-tick.png')}}" alt="">
                    <a href="{{route('loginView')}}" class="btn btn-success btn-block">Login</a>
                   
                </div>
            </div>
        </div>
    </div>
</body>

</html>