@if (!empty($count) && is_numeric($count))

    @for ($i = 1; $i <= $count; $i++)
        <div class="form-group">
            {!! Form::label('bands', 'Band '.$i.': ') !!}
            {!! Form::select('bands[]', $bands, null, ['class'=>'band_select form-control']) !!}
        </div>
    @endfor
@endif

