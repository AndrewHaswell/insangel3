@extends('admin.form')

@section('form_body')

    {!! Form::open(['action' => 'BandAdminController@store', 'files' => true]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name: ') !!}
        {!! Form::text('name', (!empty($band['band_name']) ? $band['band_name'] : null), ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Description: ') !!}
        {!! Form:: textarea('description', (!empty($band['band_description']) ? $band['band_description'] : null),
        ['class'=>'form-control']) !!}
    </div>

    @if (!empty($band['band_logo']))
        <div class="band_logo"><img src="{{ URL::asset('downloads/band_logos/'.$band['band_logo']) }}"/></div>
    @endif

    <div class="form-group">
        <?php $logo_message = !empty($band['band_logo']) ? 'Change Logo' : 'Add Logo'; ?>
        {!! Form::label('logo', $logo_message.': ') !!}
        {!! Form::file('logo', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit((!empty($submit) ? $submit : 'Add Band'), ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

@endsection

@section('footer_script')
    <script>
        // Prevent bootstrap dialog from blocking focusin
        $(document).on('focusin', function (e) {
            if ($(e.target).closest(".mce-window").length) {
                e.stopImmediatePropagation();
            }
        });
    </script>
@endsection