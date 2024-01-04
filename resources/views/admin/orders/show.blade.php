@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="card">
                    <div class="card-header">Order {{ $order->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/orders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/orders/' . $order->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/orders', $order->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Order',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        {!! Form::open([
                                                'method' => 'POST',
                                                'url' => ['/admin/orders/' . $order->id . '/store-export-data'],
                                                'style' => 'display:inline'
                                            ]) !!}
                        {!! Form::button('<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export', array(
                                'type' => 'submit',
                                'class' => 'btn btn-default btn-sm',
                                'title' => 'Store Export Data',
                                'onclick'=>'return confirm("Confirm storing data in filesystem?")'
                        )) !!}
                        {!! Form::close() !!}
                        {!! Form::open([
                            'method' => 'POST',
                            'url' => ['/admin/orders/' . $order->id . '/email'],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<i class="fa fa-envelope-o" aria-hidden="true"></i> E-mail', array(
                                'type' => 'submit',
                                'class' => 'btn btn-default btn-sm',
                                'title' => 'Send download link',
                                'onclick'=>'return confirm("Send download link to customer?")'
                        )) !!}
                        {!! Form::close() !!}
                        {!! Form::open([
                            'method' => 'POST',
                            'url' => ['/admin/orders/' . $order->id . '/download'],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<i class="fa fa-download" aria-hidden="true"></i> Download', array(
                                'type' => 'submit',
                                'class' => 'btn btn-default btn-sm',
                                'title' => 'Download Export Data',
                                'onclick'=>'return confirm("Download export data?")'
                        )) !!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $order->id }}</td>
                                    </tr>
                                    <tr><th> Matching Records </th><td> {{ $order->matching_records }} </td></tr><tr><th> Number To Purchase </th><td> {{ $order->number_to_purchase }} </td></tr><tr><th> Price </th><td> {{ $order->price }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
