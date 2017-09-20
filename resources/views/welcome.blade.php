<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            background: url('{!! url('img/background.jpg') !!}');
            color: #4f575b;
            font-family: 'Raleway', sans-serif;

            height: 100vh;
            margin: 0;
        }
        h3{
            font-weight: 600;
        }
        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
            margin-top: 25%;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                    @endauth
        </div>
    @endif
    <div class="content">
        <div class="col-md-6">
            <div class="title m-b-md">
                Chris Ruskai
            </div>
            <div class="m-b-md">
                <h3 >Professional Software Engineer providing intelligent and reliable solutions in South Florida.</h3>
            </div>
            <div class="links">
                <a target="_blank" href="https://www.linkedin.com/in/chris-ruskai-67807374/">LinkedIn</a>
                <a href="https://github.com/cruskai239/case-study">Source Code</a>
                @guest
                    <a href="{!! url('/login') !!}">Login</a>
                    @else
                        <a href="{!! url('/home') !!}">Dashboard</a>
                        @endguest
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>
</body>
</html>
