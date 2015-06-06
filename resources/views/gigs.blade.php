@extends('insangel')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @yield('gig_menu')
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">@yield('main')</div>
        <div class="col-md-5">@yield('cover')</div>
    </div>
@endsection