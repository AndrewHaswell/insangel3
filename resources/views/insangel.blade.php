<!doctype html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Gig Guide</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ URL::asset('css/main.css') }}" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: "verdana", "sans-serif";
            line-height: 1.4em;
            }

        .band_logo img {
            max-width:  300px;
            max-height: 150px;
            }

        .gig {
            border-bottom: 1px dashed lightgray;
            margin:        10px 0;
            padding:       0 0 10px 0;
            }

        .gig > .title {
            font-size:   14pt;
            font-weight: bold;
            }

        .detail, .detail-last {
            font-size:  9pt;
            font-style: italic;
            }

        .detail:after {
            content: ' / ';
            }

        #admin_menu {
            margin: 15px 0 25px 0;
            }

        #admin_menu a {
            font-size:   14pt;
            font-weight: bold;
            padding: 10px 25px;
            border: 1px solid black;
            background-color: white;
            text-decoration: none;
            }

        @if (!empty($delete))
        body {
            background-image: url("/images/body_background_admin.jpg");
            }
        @endif
    </style>
</head>
<body>
<div id="head">
    <div id="insangel_logo"><img src="{{ URL::asset('images/insangel.png') }}"/></div>
</div>
<div id="main">
    <div id="body">
        <div id="body_text">

            @yield('admin_menu')

            @if(Session::has('message'))
                <p class="alert alert-danger">{{ Session::get('message') }}</p>
            @endif

            @yield('main')

        </div>
    </div>
</div>
</body>
</html>