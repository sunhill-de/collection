@extends('visual::basic.list')

@section('title',__('List objects'))

@section('caption')
{{ __("List objects of ':key'",['key'=>$key]) }} 
@endsection

@section('tableheader')
<div class="hirarchy">
 <ul>
 <li>{{ __("Object hirarchy") }}</li>  
  @foreach ($inheritance as $ancestor)
  <li><a href="{{ route('objects.list',['key'=>$ancestor]) }}">{{ $ancestor }}</a></li>
  @endforeach  
 </ul>
</div>
@endsection

@section('tablefooter')
@if ($namespace::getInfo('instantiable'))
<button>   
<a href="{{ route('objects.add',['class'=> $key]) }}">{{ __('add') }}</a>
</button>
@endif
@endsection



  
