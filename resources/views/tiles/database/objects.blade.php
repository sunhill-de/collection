@extends('visual::basic.tile')

@section('tilecaption', __('Objects'))

@section('tilebody')
Number of Objects: <x-visual-data name="database.objects.count" />

@endsection