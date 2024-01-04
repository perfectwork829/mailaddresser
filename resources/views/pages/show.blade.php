@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div id="terms" style="padding: 25px 0 25px; line-height: 1.6">
                <h2>{{ $page->title }}</h2>
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection
