@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Import Addresses</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/addresses') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/addresses/import', 'class' => 'form-horizontal', 'files' => true]) !!}

                            <div class="form-group{{ $errors->has('processed') ? 'has-error' : ''}}">
                                {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                                <select required="required" id="name" name="name" class="form-control">
                                    <option value="">Select File</option>
                                    @foreach($files as $val)
                                        <option value="{{ $val }}">{{ $val . ' (' . \Illuminate\Support\Facades\Storage::size($val) . ' bytes)'}}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>


                            <div class="form-group">
                                {!! Form::button('Queue Import', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => 'Queue Import',
                                        'onclick'=>'return confirm("Confirm delete all existing data and import new?")'
                                )) !!}
                            </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
