@extends('admin.form')

@section('form_body')

    {!! Form::open(['action' => 'BandAdminController@store', 'files' => true]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name: ') !!}
        {!! Form::text('name', (!empty($bands['name']) ? $bands['name'] : null), ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Description: ') !!}
        {!! Form:: textarea('description', (!empty($bands['description']) ? $bands['description'] : null),
        ['class'=>'form-control']) !!}
    </div>

    @if (!empty($bands['logo']))
        <img src=""/>
    @endif

    <div class="form-group">
        {!! Form::label('logo', 'Logo: ') !!}
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