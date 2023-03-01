@extends('visual::basic.tile')

@section('tilecaption', __('Attributes'))

@section('tilebody')
Number of attributes: <x-visual-data name="database.attributes.count" />

@endsection