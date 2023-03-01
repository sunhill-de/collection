@extends('visual::basic.tile')

@section('tilecaption', __('Tags'))

@section('tilebody')
Number of Tags: <x-visual-data name="database.tags.count" />

@endsection