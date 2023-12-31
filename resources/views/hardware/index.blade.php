@extends('visual::basic.navigation')

@push('css')
  <link rel="stylesheet" href="{{ asset('/css/style.min.css') }}" />
@endpush

@section('title')
{{ __("Hardware mainpage") }}
@endsection

@section('content')
@parent
Hardware
@endsection
