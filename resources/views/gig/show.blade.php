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
            <p>Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you
                know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most
                times they're friends, like you and me! I should've known way back when... You know why, David? Because
                of the kids. They called me Mr Glass.</p>


            <p> Your bones don't break, mine do. That's clear. Your cells react to bacteria and viruses differently than
                mine. You don't get sick, I do. That's also clear. But for some reason, you and I react the exact same
                way to water. We swallow it too fast, we choke. We get some in our lungs, we drown. However unreal it
                may seem, we are connected, you and I. We're on the same curve, just on opposite ends.</p>

            <p>Normally, both your asses would be dead as fucking fried chicken, but you happen to pull this shit while
                I'm in a transitional period so I don't wanna kill you, I wanna help you. But I can't give you this
                case, it don't belong to me. Besides, I've already been through too much shit this morning over this
                case to hand it over to your dumb ass.</p>


        </div>
    @endif
@endsection