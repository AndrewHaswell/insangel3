@extends('gigs')

@section('gig_menu')
    <a href="{{url('/')}}">Gigs by Date</a> <a href="{{url('bands')}}">Gigs by Band</a> <a
            href="{{url('venues')}}">Gigs by Venue</a>
@endsection

@section('main')
    @if (!empty($gigs))
        <h2>Gigs</h2>
        @foreach ($gigs as $gig)
            <div class="gig_before"></div>
            <div class="gig">
                @if (!empty($gig['title']))
                    <div class="gig_title">{{ $gig['title']}}</div>
                @endif
                @if (!empty($gig['subtitle']))
                    <div class="subtitle">{{$gig['subtitle']}}</div>
                @endif
                <div class="gig_date">
                    {{Carbon\Carbon::parse($gig['datetime'])->format('l jS F Y')}}
                </div>
                <div class="venue">{{$gig['venue']['venue_name']}}</div>
                <div class="bands">
                    <?php $band_count = count($gig['bands']); ?>
                    <?php $counter = 1; ?>
                    @foreach ($gig['bands'] as $band)
                        <span class="band"><a
                                    href="{{!empty($delete)?'/admin/band/'.$band['id'].'/edit':'#'}}">{{$band['band_name']}}</a></span>
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
            <div class="gig_after"></div>

        @endforeach
    @endif
@endsection


@section('cover')
    @if (!empty($cover_gigs))
        <h2>Cover Gigs</h2>
        <div id="cover_gigs">

            @if (!empty($cover_gigs))
                @foreach ($cover_gigs as $cover_gig)

                    @if (count($cover_gig['gigs'])>0)

                        <div class="cover_gig_title">{{$cover_gig['venue_name']}}</div>

                        <div class="cover_gigs">
                            @if (!empty($cover_gig['gigs']))

                                @foreach ($cover_gig['gigs'] as $gig)
                                    <div id="cover_gig">{{date('l jS F', strtotime($gig['datetime']))}}
                                        :: {{implode(' | ', $gig->bands->lists('band_name'))}}</div>
                                @endforeach

                            @endif
                        </div>
                    @endif
                @endforeach
            @endif


        </div>
    @endif
@endsection