@extends('insangel')

@section('gig_menu')
    <div id="admin_menu">
        <a href="{{url('/')}}">Gigs by Date</a> <a href="{{url('bands')}}">Gigs by Band</a> <a
                href="{{url('venues')}}">Gigs by Venue</a>
    </div>
@endsection

@section('main')
    @foreach ($bands as $band)
        <div id="band">

            @if (!empty($band['band_logo']) && file_exists('downloads/band_logos/'.$band['band_logo']))
                <div class="band_logo"><img title="{{$band['band_name']}}"
                                            src="{{ URL::asset('downloads/band_logos/'.$band['band_logo']) }}"/></div>
            @else
                <h1>{{$band['band_name']}}</h1>
            @endif

            @foreach ($band['gigs'] as $gig)
                <p>{{$gig['venue']['venue_name']}} - {{date('jS M y', strtotime($gig['datetime']))}}</p>
            @endforeach
        </div>
    @endforeach
@endsection