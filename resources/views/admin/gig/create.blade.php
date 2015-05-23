<!doctype html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Create.blade</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.css"
          rel="stylesheet"/>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>


</head>

<body>
<div class="container">
    <h1>New Gig</h1>
    <hr/>

    @if ($errors->any())

        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif

    {!! Form::open(['action' => 'GigAdminController@store']) !!}

    <div class="form-group">
        {!! Form::label('date', 'Date: ') !!}
        {!! Form::text('date', null, ['id'=>'datepicker', 'class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('title', 'Title: ') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('subtitle', 'Subtitle: ') !!}
        {!! Form::text('subtitle', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('cost', 'Cost: ') !!}
        {!! Form::text('cost', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('notes', 'Notes: ') !!}
        {!! Form::text('notes', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('venue', 'Venue: ') !!}
        {!! Form::select('venue', $venues, null, ['id' => 'venue',
        'class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('number_of_bands', 'Number of Bands: ') !!}
        {!! Form::select('number_of_bands', range(0,10), null, ['id' => 'number_of_bands', 'class'=>'form-control']) !!}
    </div>

    <span id="band_list"></span>

    <div class="form-group">
        {!! Form::submit('Add Gig', ['class' => 'btn btn-primary form-control']) !!}
    </div>


    {!! Form::close() !!}
</div>

<script>

    $(function () {

        $("#venue").select2({
            placeholder: "Select a venue from the list or create a new one",
            tags: true
        });

        $("#number_of_bands").select2({
            placeholder: "Select the number of bands for this gig",
            tags: true
        });

        $("#datepicker").datetimepicker({hour: "20", dateFormat: "yy-mm-dd", timeformat: "HH:mm:ss"});

        $('#number_of_bands').bind('change', function () {
            var band_count = $('#number_of_bands').val();
            $.ajax
            (
                    {
                        url: '{{ url('ajax/bands') }}/' + band_count,
                        dataType: 'html',
                        type: 'GET',
                        async: true,
                        success: function (data) {
                            $('#band_list').html(data);
                            $(".band_select").select2({
                                placeholder: "Select band from list, create new one or leave empty for TBC",
                                tags: true
                            });
                        }
                    }
            );
        });
    });

</script>
</body>


</html>