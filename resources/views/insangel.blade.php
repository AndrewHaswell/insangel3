<!doctype html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Gig Guide</title>
    <link href='http://fonts.googleapis.com/css?family=Montez' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,700,400' rel='stylesheet' type='text/css'>
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
            background-image: url("{{ URL::asset('images/body_background_admin.jpg') }}");
            }
        @endif
    </style>
</head>
<body>
<div id="head">
    <div id="insangel_logo"><img src="{{ URL::asset('images/insangel.png') }}"/></div>

    @include('includes.menu')
</div>
<div id="main">
    <div id="body">
        <div id="body_text">

            @yield('admin_menu')
            @yield('gig_menu')

            @if(Session::has('message'))
                <p class="alert alert-danger">{{ Session::get('message') }}</p>
            @endif


            @yield('main')
            @yield('cover')

        </div>
    </div>
</div>
@include('includes.footer')
</body>
</html>
<script>
    $(function () {

        $('.sub').each(
                function () {
                    var main_class = $(this).attr('id').split('_').pop();
                    var main_height = $('#navigation_' + main_class).find('a:first').height();
                    var main_width = $('#navigation_' + main_class).find('a:first').width();


                    var offset = $('#navigation_' + main_class).find('a:first').offset();

                    console.log(offset);

                }
        );

        $(".navigation_link").bind("mouseover", function () {
            $('.sub').hide();
        });

        $(".navigation_category").bind("mouseover", function () {
            $('.sub').hide();
            var sub_class = $(this).attr('id').split('_').pop();
            $('.sub_' + sub_class).show();
        });

    });
</script>