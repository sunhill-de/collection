@extends('visual::basic.navigation')

@push('css')
  <link rel="stylesheet" href="{{ asset('/css/style.min.css') }}" />
@endpush

@section('title')
{{ __("News mainpage") }}
@endsection

@section('content')
@parent
Nachrichten
@endsection
