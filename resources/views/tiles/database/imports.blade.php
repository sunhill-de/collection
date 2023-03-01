@extends('visual::basic.tile')

@section('tilecaption', __('Imports'))

@section('tilebody')
<ul>
<li>{{ __('Total number of waiting imports') }}: <x-visual-data name="database.totalimports.count" /></li>
<li>{{ __('Number of waiting movie imports') }}: <x-visual-data name="database.movieimports.count" /></li>
<li>{{ __('Number of waiting book imports') }}: <x-visual-data name="database.bookimports.count" /></li>
<li>{{ __('Number of waiting person imports') }}: <x-visual-data name="database.personimports.count" /></li>
</ul>
@endsection