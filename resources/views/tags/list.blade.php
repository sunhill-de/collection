@extends('visual::basic.list')

@section('title',__('List tags'))

@section('caption')
{{ __('List tags') }}
@endsection

@section('tablefooter')
<button>   
<a href="{{ route('tags.add',['class'=> $key]) }}">{{ __('add') }}</a>
</button>
@endsection
