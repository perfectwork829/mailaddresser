<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('gender') ? 'has-error' : ''}}">
    {!! Form::label('gender', 'Gender', ['class' => 'control-label']) !!}
    {!! Form::text('gender', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('mobile1') ? 'has-error' : ''}}">
    {!! Form::label('mobile1', 'Mobile1', ['class' => 'control-label']) !!}
    {!! Form::text('mobile1', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('mobile1', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('mobile2') ? 'has-error' : ''}}">
    {!! Form::label('mobile2', 'Mobile2', ['class' => 'control-label']) !!}
    {!! Form::text('mobile2', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('mobile2', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('mobile3') ? 'has-error' : ''}}">
    {!! Form::label('mobile3', 'Mobile3', ['class' => 'control-label']) !!}
    {!! Form::text('mobile3', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('mobile3', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('mobile4') ? 'has-error' : ''}}">
    {!! Form::label('mobile4', 'Mobile4', ['class' => 'control-label']) !!}
    {!! Form::text('mobile4', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('mobile4', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('phone1') ? 'has-error' : ''}}">
    {!! Form::label('phone1', 'Phone1', ['class' => 'control-label']) !!}
    {!! Form::text('phone1', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone1', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('phone2') ? 'has-error' : ''}}">
    {!! Form::label('phone2', 'Phone2', ['class' => 'control-label']) !!}
    {!! Form::text('phone2', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone2', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('phone3') ? 'has-error' : ''}}">
    {!! Form::label('phone3', 'Phone3', ['class' => 'control-label']) !!}
    {!! Form::text('phone3', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone3', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('streetaddress') ? 'has-error' : ''}}">
    {!! Form::label('streetaddress', 'Streetaddress', ['class' => 'control-label']) !!}
    {!! Form::text('streetaddress', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('streetaddress', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('zipcode') ? 'has-error' : ''}}">
    {!! Form::label('zipcode', 'Zipcode', ['class' => 'control-label']) !!}
    {!! Form::text('zipcode', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('zipcode', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('town') ? 'has-error' : ''}}">
    {!! Form::label('town', 'Town', ['class' => 'control-label']) !!}
    {!! Form::text('town', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('town', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('birthdate') ? 'has-error' : ''}}">
    {!! Form::label('birthdate', 'Birthdate', ['class' => 'control-label']) !!}
    {!! Form::number('birthdate', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('birthdate', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('living') ? 'has-error' : ''}}">
    {!! Form::label('living', 'Living', ['class' => 'control-label']) !!}
    {!! Form::text('living', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('living', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
