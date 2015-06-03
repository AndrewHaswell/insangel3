@extends('insangel')

@section('admin_menu')
    @if (!empty($delete))
        <div id="admin_menu">
            <a href="{{url('admin/gig/create')}}">Add Gig</a> <a href="{{url('admin/band/create')}}">Add Band</a> <a
                    href="{{url('admin/venue/create')}}">Add Venue</a>
        </div>
    @endif
@endsection

@section('gig_menu')
    @if (empty($delete))
        <div id="admin_menu">
            <a href="{{url('/')}}">Gigs by Date</a> <a href="{{url('bands')}}">Gigs by Band</a> <a
                    href="{{url('venues')}}">Gigs by Venue</a>
        </div>
    @endif
@endsection

@section('main')
    @if (!empty($gigs))
        <h2>Gigs</h2>
        @foreach ($gigs as $gig)
            <div class="gig">
                <div class="gig_title">{{ $gig['title'] ? $gig['title'] . ' :: ': '' }}{{Carbon\Carbon::parse($gig['datetime'])->format('D jS M y')}}
                    @if (!empty($delete))

                        <span class="edit"><a href="/admin/gig/{{$gig['id']}}/edit"><img
                                        src="{{ URL::asset('images/edit.png') }}"/></a></span>
                    @endif
                </div>
                @if (!empty($gig['subtitle']))
                    <div class="subtitle">{{$gig['subtitle']}}</div>
                @endif
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

        @endforeach
    @endif
@endsection


@section('cover')
    @if (!empty($cover_gigs))
        <h2>Cover Gigs</h2>
        @foreach ($cover_gigs as $gig)
            <div class="gig">
                <div class="gig_title">{{ $gig['title'] ? $gig['title'] . ' :: ': '' }}{{Carbon\Carbon::parse($gig['datetime'])->format('D jS M y')}}
                    @if (!empty($delete))
                        <span class="delete"><a href="#"><img src="{{ URL::asset('images/delete.png') }}"/></a></span>
                        <span class="edit"><a href="/admin/gig/{{$gig['id']}}/edit"><img
                                        src="{{ URL::asset('images/edit.png') }}"/></a></span>
                    @endif
                </div>
                @if (!empty($gig['subtitle']))
                    <div class="subtitle">{{$gig['subtitle']}}</div>
                @endif
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

        @endforeach
    @endif
@endsection