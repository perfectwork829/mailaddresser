<div class="form-group{{ $errors->has('matching_records') ? 'has-error' : ''}}">
    {!! Form::label('matching_records', 'Matching Records', ['class' => 'control-label']) !!}
    {!! Form::number('matching_records', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('matching_records', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('number_to_purchase') ? 'has-error' : ''}}">
    {!! Form::label('number_to_purchase', 'Number To Purchase', ['class' => 'control-label']) !!}
    {!! Form::text('number_to_purchase', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('number_to_purchase', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'control-label']) !!}
    {!! Form::number('price', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('vat') ? 'has-error' : ''}}">
    {!! Form::label('vat', 'Vat', ['class' => 'control-label']) !!}
    {!! Form::number('vat', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('vat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('discount_code') ? 'has-error' : ''}}">
    {!! Form::label('discount_code', 'Discount Code', ['class' => 'control-label']) !!}
    {!! Form::text('discount_code', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('discount_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('discount_percent') ? 'has-error' : ''}}">
    {!! Form::label('discount_percent', 'Discount Percent', ['class' => 'control-label']) !!}
    {!! Form::text('discount_percent', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('discount_percent', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('path') ? 'has-error' : ''}}">
    {!! Form::label('path', 'Path', ['class' => 'control-label']) !!}
    {!! Form::text('path', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('path', '<p class="help-block">:message</p>') !!}
</div>
{{--<div class="form-group{{ $errors->has('gender') ? 'has-error' : ''}}">
    {!! Form::label('gender', 'Gender', ['class' => 'control-label']) !!}
    {!! Form::text('gender', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('age') ? 'has-error' : ''}}">
    {!! Form::label('age', 'Age', ['class' => 'control-label']) !!}
    {!! Form::text('age', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('age', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('geography') ? 'has-error' : ''}}">
    {!! Form::label('geography', 'Geography', ['class' => 'control-label']) !!}
    {!! Form::text('geography', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('geography', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('living_type') ? 'has-error' : ''}}">
    {!! Form::label('living_type', 'Living Type', ['class' => 'control-label']) !!}
    {!! Form::text('living_type', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('living_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('phone_numbers') ? 'has-error' : ''}}">
    {!! Form::label('phone_numbers', 'Phone Numbers', ['class' => 'control-label']) !!}
    {!! Form::text('phone_numbers', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone_numbers', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('exclude') ? 'has-error' : ''}}">
    {!! Form::label('exclude', 'Exclude', ['class' => 'control-label']) !!}
    {!! Form::textarea('exclude', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('exclude', '<p class="help-block">:message</p>') !!}
</div>--}}
<div class="form-group{{ $errors->has('first_name') ? 'has-error' : ''}}">
    {!! Form::label('first_name', 'First Name', ['class' => 'control-label']) !!}
    {!! Form::text('first_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('last_name') ? 'has-error' : ''}}">
    {!! Form::label('last_name', 'Last Name', ['class' => 'control-label']) !!}
    {!! Form::text('last_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('company_name') ? 'has-error' : ''}}">
    {!! Form::label('company_name', 'Company Name', ['class' => 'control-label']) !!}
    {!! Form::text('company_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('organization_number') ? 'has-error' : ''}}">
    {!! Form::label('organization_number', 'Organization Number', ['class' => 'control-label']) !!}
    {!! Form::text('organization_number', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('organization_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
    {!! Form::text('email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
    {!! Form::text('phone', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('postal_address') ? 'has-error' : ''}}">
    {!! Form::label('postal_address', 'Postal Address', ['class' => 'control-label']) !!}
    {!! Form::text('postal_address', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('postal_address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('message') ? 'has-error' : ''}}">
    {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
    {!! Form::textarea('message', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('zip') ? 'has-error' : ''}}">
    {!! Form::label('zip', 'Zip', ['class' => 'control-label']) !!}
    {!! Form::text('zip', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('zip', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('area') ? 'has-error' : ''}}">
    {!! Form::label('area', 'Area', ['class' => 'control-label']) !!}
    {!! Form::text('area', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('area', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('payment_option') ? 'has-error' : ''}}">
    {!! Form::label('payment_option', 'Payment Option', ['class' => 'control-label']) !!}
    {!! Form::select('payment_option', \App\Order::$payment_options, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('payment_option', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
    {!! Form::select('status', \App\Order::$statuses, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
