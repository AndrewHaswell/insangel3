@if (!empty($count) && is_numeric($count))

    @for ($i = 1; $i <= $count; $i++)
        <div class="form-group">
            {!! Form::label('band_'.$i, 'Band '.$i.': ') !!}
            {!! Form::select('band_'.$i, $bands, null, ['class'=>'band_select form-control']) !!}
        </div>
    @endfor
@endif

