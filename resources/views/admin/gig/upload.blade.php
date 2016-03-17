@extends('admin.form')

@section('form_body')

  {!! Form::open(['action' => 'UploadAdminController@store']) !!}

  <div class="form-group">
    {!! Form::label('notes', 'Notes: ') !!}
    {!! Form::textarea('notes', null, ['class'=>'form-control no_editor', 'rows'=>'5']) !!}
  </div>

  <div class="form-group">
    {!! Form::label('cover', 'Cover Gig?') !!}
    {!! Form::checkbox('cover', 1, (!empty($gigs['cover']) && $gigs['cover'] == 'Y' ? true : false) ) !!}
  </div>


  <div class="form-group">
    {!! Form::submit( 'Upload Gig List', ['class' => 'btn btn-primary form-control']) !!}
  </div>

  {!! Form::close() !!}



@endsection