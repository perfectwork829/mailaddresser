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
                    <div class="card-header">Orders</div>
                    <div class="card-body">
{{--                        <a href="{{ url('/admin/orders/create') }}" class="btn btn-success btn-sm" title="Add New Order">--}}
{{--                            <i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
{{--                        </a>--}}

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/orders', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Number To Purchase</th>
                                        <th>Price</th>
                                        <th>Total to pay</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->first_name }}<br>{{ $item->last_name }}</td>
                                        <td>{{ $item->number_to_purchase }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->totalToPay }}</td>
                                        <td>{{ \App\Order::$statuses[$item->status] }}</td>
                                        <td>
                                            <a href="{{ url('/admin/orders/' . $item->id) }}" title="View Order"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/admin/orders/' . $item->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/orders', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Order',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                            <br>
                                            {!! Form::open([
                                                'method' => 'POST',
                                                'url' => ['/admin/orders/' . $item->id . '/store-export-data'],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-file-excel-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-default btn-sm',
                                                    'title' => 'Store Export Data',
                                                    'onclick'=>'return confirm("Confirm storing data in filesystem?")'
                                            )) !!}
                                            {!! Form::close() !!}
                                            {!! Form::open([
                                                'method' => 'POST',
                                                'url' => ['/admin/orders/' . $item->id . '/email'],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-envelope-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-default btn-sm',
                                                    'title' => 'Send download link',
                                                    'onclick'=>'return confirm("Send download link to customer?")'
                                            )) !!}
                                            {!! Form::close() !!}
                                            {!! Form::open([
                                                'method' => 'POST',
                                                'url' => ['/admin/orders/' . $item->id . '/download'],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-download" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-default btn-sm',
                                                    'title' => 'Download Export Data',
                                                    'onclick'=>'return confirm("Download export data?")'
                                            )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $orders->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
