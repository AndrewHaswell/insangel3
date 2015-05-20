<!doctype html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Create.blade</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.css" rel="stylesheet"/>
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

    {!! Form::open() !!}

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
        {!! Form::label('venue', 'Venue: ') !!}
        {!! Form::select('venue', [1 => 'Andy', 2 => 'Bob', 3 => 'Something'], null, ['id' => 'venue',
        'class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('bands', 'Bands: ') !!}
        {!! Form::select('bands[]', [1 => 'Andy', 2 => 'Bob', 3 => 'Something'], null, ['id' => 'bands',
        'class'=>'form-control', 'multiple']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Add Gig', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}
</div>
<script>
    $(function () {
        $("#venue").select2({
            placeholder: "Balls",
            tags: true
        });
        $("#bands").select2({
            placeholder: "Balls",
            tags: true
        });
        $("#datepicker").datetimepicker();
    });

</script>
</body>


</html>