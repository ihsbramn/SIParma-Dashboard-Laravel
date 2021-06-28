@extends('layouts.app')

@section('meta')
    <meta http-equiv="refresh" content="20">
@endsection

@section('content')
    <h1 class="text-center">Report</h1>

@endsection

@section('script')
    <script>
        window.setTimeout(function() {
            window.location.reload();
        }, 20000);
    </script>
@endsection
