@extends('insangel')

@section('main')
    @foreach ($venues as $venue)
        <div id="venue">
            <h1>{{$venue['venue_name']}}</h1>

            @if (!empty($venue['venue_logo']) && file_exists('downloads/venue_logos/'.$venue['venue_logo']))
                <div class="venue_logo"><img src="{{ URL::asset('downloads/venue_logos/'.$venue['venue_logo']) }}"/>
                </div>
            @endif

            @foreach ($venue['gigs'] as $gig)
                <?php $band_list = $gig->bands->lists('band_name'); ?>
                <p>{{date('jS M y', strtotime($gig['datetime']))}}</p>
                @if (!empty($band_list) && is_array($band_list))
                    <p>{{implode(' / ', $band_list)}}</p>
                @endif
            @endforeach
        </div>
    @endforeach
@endsection