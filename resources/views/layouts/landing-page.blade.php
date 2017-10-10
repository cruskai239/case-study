<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{!! $viewObj->title !!}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{!! url('css/bootstrap.min.css') !!}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{!! url('css/opw.css') !!}" rel="stylesheet">
    <script src="https://use.fontawesome.com/26b0317775.js"></script>
    <style>
        .header-image{
            background: url('{!! url($viewObj->jumbotron->image) !!}') no-repeat center center scroll;
            margin-top: -8px;
        }

        .headline h1{
            font-size: 3em;
            background: rgba(255,255,255,0.25);
        }
        .headline h2{
            font-size: 2em;
            background: rgba(255,255,255,0.25);
        }
        .headline-button{
            height: 80px;
            max-width: 400px;
            font-size: 3em;
            box-shadow: 2px 2px 1px #888888;
        }
        .panel{
            box-shadow: 5px 5px 3px #888888;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{!! $viewObj->brand !!}</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @foreach($viewObj->links as $link)
                    <li>
                        <a href="{!! $link['href'] !!}">{!! $link['label'] !!}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<!-- Full Width Image Header -->
<header class="header-image">
    <div class="headline">
        <div class="container">
            <div class="panel panel-default">
            	<div class="panel-body">
                    <h1>{!! $viewObj->jumbotron->title !!}</h1>
                    <h2>{!! $viewObj->jumbotron->subtitle !!}</h2>
                    <div class="form-group">
                        <button type="button" class="btn btn-success btn-block center-block headline-button"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp;{!! $viewObj->jumbotron->buttonText !!}</button>
                    </div>
            	</div>
            </div>

        </div>
    </div>
</header>
<!-- Page Content -->
<div class="container">
    <hr class="featurette-divider">
    @foreach($viewObj->featurettes as $featurette)
        <div class="featurette" id="about">
            <img class="featurette-image img-circle img-responsive {!! $loop->index % 2 == 0 ? 'pull-left' : 'pull-right' !!}"
                 src="{!! url($featurette->image) !!}">
            <h2 class="featurette-heading">{!! $featurette->title !!}
                <span class="text-muted">{!! $featurette->subtitle !!}</span>
            </h2>
            <p class="lead">{!! $featurette->description !!}</p>
        </div>
        @if(!$loop->last)
            <hr class="featurette-divider">
        @endif
    @endforeach



    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p class="pull-right">{!! $viewObj->footer !!}</p>
            </div>
        </div>
    </footer>
</div>
<!-- /.container -->
<!-- jQuery -->
<script src="{!! url('js/jquery.js') !!}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{!! url('js/bootstrap.min.js') !!}"></script>
</body>
</html>
