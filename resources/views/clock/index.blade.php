@extends('visual::basic.navigation')

@push('css')
  <link rel="stylesheet" href="{{ asset('/css/style.min.css') }}" />
@endpush

@section('title')
{{ __("News mainpage") }}
@endsection

@section('content')
@parent
  <canvas id="canvas_large" height="800" width="800" margin="auto">cccc</canvas>
@endsection
