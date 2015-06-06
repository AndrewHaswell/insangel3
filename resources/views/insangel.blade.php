<!doctype html>
<html lang="en-GB">

<head>

    <meta charset="UTF-8">
    <title>Gig Guide</title>

    <link href='http://fonts.googleapis.com/css?family=Montez' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,700,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Patrick+Hand|Just+Another+Hand' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ URL::asset('css/gig.css') }}" rel="stylesheet">

    <style>

        #navigation {
            position: absolute;
            top:      5px;
            right:    5px;
            }

        body {
            background-image: url("{{ URL::asset('images/graffiti_background.png') }}");
            font-family:      Roboto;
            }

        .container {
            padding:      0;
            border:       18px solid transparent;
            border-image: url("{{ URL::asset('images/dirt_border.png') }}") 18 18 repeat;
            }

        .body_text {
            background-image: url("{{ URL::asset('images/dirt.png') }}");
            padding:          0 20px 30px 20px;
            }

        #cover_gigs {
            background-color: white;
            padding:          10px;
            border:           1px solid black;
            }

        .band_logo img {
            display: block;
            margin:  -1px auto;
            }


    </style>

</head>

<body>
<div class="container" style="border:none; margin-bottom: -25px">

    <div id="insangel_logo"><img src="{{ URL::asset('images/insangel.png') }}"/></div>

</div>

<div id="navigation" style="display:none">
    @include('includes.menu')
</div>

@if(Session::has('message'))
    <div class="container">
        <div class="body_text">
            <p class="alert alert-danger">{{ Session::get('message') }}</p>
        </div>
    </div>
@endif

<div class="container">
    <div class="body_text">
        @yield('content')
    </div>
</div>

</body>
</html>