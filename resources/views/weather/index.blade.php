@extends('visual::basic.navigation')

@push('css')
  <link rel="stylesheet" href="{{ asset('/css/style.min.css') }}" />
@endpush

@section('title')
{{ __("Weather mainpage") }}
@endsection

@section('content')
@parent
Wetter
@endsection
