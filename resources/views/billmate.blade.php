@extends('layouts.app')

@section('content')
    <div>
        {!! $checkout->iframe() !!}
    </div>
@endsection
@section('scripts')
    <script>
        window.addEventListener('message', function (event) {
            if (event.origin !== 'https://checkout.billmate.se') {
                return
            }
            try {
                var json = JSON.parse(event.data)
            } catch (e) {
                return
            }
            if (json.event === 'content_height') {
                $('#checkout').height(json.data)
            }
        })
    </script>
@endsection