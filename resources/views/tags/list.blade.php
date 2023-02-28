@extends('visual::basic.list')

@section('title',__('List tags'))

@section('caption')
{{ __('List tags') }}
@endsection

@section('tablefooter')
<button>   
<a href="{{ route('tags.add') }}">{{ __('add') }}</a>
</button>
@endsection
