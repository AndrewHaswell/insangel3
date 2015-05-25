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
    </style>
</head>
<body>
<div id="head">
    <div id="insangel_logo"><img src="{{ URL::asset('images/insangel.png') }}"/></div>
</div>
<div id="main">
    <div id="side_bar">
        <div id="side_bar_text">
            <h1>Cover Gigs and Venues</h1>
        </div>
    </div>
    <div id="body">
        <div id="body_text">


            @if(Session::has('message'))
                <p class="alert alert-danger">{{ Session::get('message') }}</p>
            @endif


            @if (!empty($gigs))
                @foreach ($gigs as $gig)
                    <div class="gig">
                        <div class="gig_title">{{ $gig['title'] ? $gig['title'] . ' :: ': '' }}{{Carbon\Carbon::parse($gig['datetime'])->format('D jS M y')}}</div>
                        @if (!empty($delete))
                            <span class="delete"><a href="#">Delete Gig</a></span>
                            <span class="edit"><a href="/admin/gig/{{$gig['id']}}/edit">Edit Gig</a></span>
                        @endif
                        @if (!empty($gig['subtitle']))
                            <div class="subtitle">{{$gig['subtitle']}}</div>
                        @endif
                        <div class="venue">{{$gig['venue']['venue_name']}}</div>
                        <div class="bands">
                            <?php $band_count = count($gig['bands']); ?>
                            <?php $counter = 1; ?>
                            @foreach ($gig['bands'] as $band)
                                <span class="band"><a href="#">{{$band['band_name']}}</a></span>
                                @if ($counter < $band_count)
                                    <span class="band_separator">-</span>
                                @endif
                                <?php $counter++; ?>
                            @endforeach
                        </div>
                        <div class="details">
                            @if (!empty($gig['notes']))
                                <span class="detail">{{$gig['notes']}}</span>
                            @endif
                            @if (!empty($gig['cost']))
                                <span class="detail">{{is_numeric($gig['cost']) ? '&pound;' . number_format($gig['cost'], 2) : $gig['cost']}}</span>
                            @endif
                            <span class="detail">{{Carbon\Carbon::parse($gig['datetime'])->format('g:i a')}}</span>
                            <span class="detail-last">07901 616 185</span>


                        </div>
                    </div>

                @endforeach
            @endif
        </div>
    </div>
</div>
</body>
</html>