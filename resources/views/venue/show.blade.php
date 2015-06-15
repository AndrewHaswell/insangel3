@extends('venues')

@section('main')
    <?php $venue_counter = 1; ?>
    <h2>Gigs by Venue</h2>
    @foreach ($venues as $venue)
        @if ($venue_counter === 1)
            <div class="row">
                @endif
                <div class="col-md-4">
                    <div class="gig_before"></div>
                    <div class="gig">

                        @if (!empty($venue['venue_logo']) && file_exists('downloads/venue_logos/'.$venue['venue_logo']))
                            <div class="band_logo"><img src="{{ URL::asset('downloads/venue_logos/'.$venue['venue_logo']) }}"/>
                            </div>
                        @else
                            <div class="band_title">{{$venue['venue_name']}}</div>
                        @endif

                        @foreach ($venue['gigs'] as $gig)
                            <div class="venue_page_gig">
                            <?php $band_list = $gig->bands->lists('band_name'); ?>
                            <p class="small_gig_date">{{date('jS M y', strtotime($gig['datetime']))}}</p>
                            @if (!empty($band_list) && is_array($band_list))
                                <p class="small_band_list">{{implode(' / ', $band_list)}}</p>
                            @endif
                            </div>
                        @endforeach
                        <div>&nbsp;</div>
                    </div>
                    <div class="gig_after"></div>
                </div>
                @if ($venue_counter % 3 == 0)
            </div>
            <?php $venue_counter = 1;?>
        @else
            <?php $venue_counter++;?>
        @endif

    @endforeach
@endsection