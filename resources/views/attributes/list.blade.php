@extends('visual::basic.list')

@section('title',__('List attributes'))

@section('caption')
{{ __('List attributes') }}
@endsection

@section('tablefooter')
<button>   
<a href="{{ route('attributes.add') }}">{{ __('add') }}</a>
</button>
@endsection
