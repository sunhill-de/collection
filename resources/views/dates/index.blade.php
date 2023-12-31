@extends('visual::basic.navigation')

@push('css')
  <link rel="stylesheet" href="{{ asset('/css/style.min.css') }}" />
@endpush

@section('title')
{{ __("Dates mainpage") }}
@endsection

@section('content')
@parent
Termine
@endsection
