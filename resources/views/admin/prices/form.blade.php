<div class="form-group{{ $errors->has('from_number') ? 'has-error' : ''}}">
    {!! Form::label('from_number', 'From Number', ['class' => 'control-label']) !!}
    {!! Form::number('from_number', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('from_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('to_number') ? 'has-error' : ''}}">
    {!! Form::label('to_number', 'To Number', ['class' => 'control-label']) !!}
    {!! Form::number('to_number', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('to_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'control-label']) !!}
    {!! Form::select('type', \App\Price::$types, null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'control-label']) !!}
    {!! Form::text('price', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
