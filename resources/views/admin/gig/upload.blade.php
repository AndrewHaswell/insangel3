@extends('admin.form')

@section('form_body')

    {!! Form::open(['action' => 'UploadAdminController@store']) !!}





    <div class="form-group">
        {!! Form::label('notes', 'Notes: ') !!}
        {!! Form::text('notes', (!empty($gigs['notes']) ? $gigs['notes'] : null), ['class'=>'form-control']) !!}
    </div>



    <div class="form-group">
        {!! Form::submit( 'Upload Gig List', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}



@endsection