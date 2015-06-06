@extends('bands')

@section('gig_menu')
    <div id="admin_menu">
        <a href="{{url('/')}}">Gigs by Date</a> <a href="{{url('bands')}}">Gigs by Band</a> <a
                href="{{url('venues')}}">Gigs by Venue</a>
    </div>
@endsection

@section('main')
    <?php $band_counter = 1; ?>
    @foreach ($bands as $band)
        @if ($band_counter === 1)
            <div class="row">
                @endif
                <div class="col-md-4">
                    <div class="gig_before"></div>
                    <div class="gig">
                        @if (!empty($band['band_logo']) && file_exists('downloads/band_logos/'.$band['band_logo']))
                            <div class="band_logo"><img style="max-width: 90%" title="{{$band['band_name']}}"
                                                        src="{{ URL::asset('downloads/band_logos/'.$band['band_logo']) }}"/>
                            </div>
                        @else
                            <h1>{{$band['band_name']}}</h1>
                        @endif
                        @foreach ($band['gigs'] as $gig)
                            <p>{{$gig['venue']['venue_name']}} - {{date('jS M y', strtotime($gig['datetime']))}}</p>
                        @endforeach
                        <div>&nbsp;</div>
                    </div>
                    <div class="gig_after"></div>
                </div>
                @if ($band_counter % 3 == 0)
            </div>
            <?php $band_counter = 1;?>
        @else
            <?php $band_counter++;?>
        @endif

    @endforeach
@endsection