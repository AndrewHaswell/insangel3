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
            background-image: url("{{ URL::asset('images/body_background.jpg') }}");
            }

        .container {
            padding:      0;
            border:       12px solid transparent;
            border-image: url("{{ URL::asset('images/dirt_border.png') }}") 12 12 repeat;
            }

        .body_text {
            background-image: url("{{ URL::asset('images/dirt.png') }}");
            padding:          0 20px 30px 20px;
            }


    </style>

</head>

<body>
<div id="head">
    <div id="insangel_logo"><img src="{{ URL::asset('images/insangel.png') }}"/></div>
</div>

<div id="navigation" style="display:none">
    @include('includes.menu')
</div>

<div class="container">
    <div class="body_text">
        @yield('admin_menu')
        @yield('gig_menu')
    </div>
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

        <div class="row">
            <div class="col-md-7">@yield('main')</div>
            <div class="col-md-5">@yield('cover')</div>
        </div>

    </div>
</div>

<div class="container">
    <div class="body_text">
        @include('includes.footer')
    </div>
</div>

</body>
</html>