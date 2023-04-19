@extends('visual::basic.list')

@section('title',__('List movies'))

@section('caption')
{{ __('List movies') }}
@endsection

@section('tablefooter')
<a href="{{ route('imports.movies.add') }}">{{ __('Add series') }}</a>
@endsection  