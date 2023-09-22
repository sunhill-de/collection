@extends('visual::basic.list')  

@section('title',__('List collection objects'))

@section('caption')
{{ __("List collection objects of ':collection'",['collection'=>$collectionname]) }} 
@endsection

@section('tablefooter')
@if ($instantiable)
<button>   
<a href="{{ route('collection.add',['collection'=> $collectionname]) }}">{{ __('add') }}</a>
</button> 
@endif
@endsection



  
