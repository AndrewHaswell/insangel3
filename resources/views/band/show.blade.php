@extends('insangel')

@section('main')
    @foreach ($bands as $band)
        <div id="band">
        <h1>{{$band['band_name']}}</h1>

        @if (!empty($band['band_logo']) && file_exists('downloads/band_logos/'.$band['band_logo']))
            <div class="band_logo"><img src="{{ URL::asset('downloads/band_logos/'.$band['band_logo']) }}"/></div>
        @endif

        @foreach ($band['gigs'] as $gig)
            <p>{{$gig['venue']['venue_name']}} - {{date('jS M y', strtotime($gig['datetime']))}}</p>
        @endforeach
        </div>
    @endforeach
@endsection