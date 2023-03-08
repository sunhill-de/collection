@extends('visual::basic.navigation')

@section('title',__('Show tag') )

@section('caption')
{{ __('Show tag') }}
@endsection

@section('content')
@parent

<table class="table">
 <caption>{{ __('Fields') }}</caption>
 <thead>
     <tr>
      <th>{{ __('Field') }}</th>
      <th>{{ __('Value') }}</th>
     </tr>
 </thead>
 <tbody>
     <tr>
      <td>{{ __('Name') }}</td>
      <td>{{ $name }}</td>
     </tr>
     <tr>
      <td>{{ __('Parent') }}</td>
      <td>{{ $parent }}</td>
     </tr>
     <tr>
      <td>{{ __('Full path') }}</td>
      <td>{{ $fullpath }}</td>
     </tr>
      <tr>
      <td>{{ __('leafable') }}</td>
      <td>{{ $leafable }}</td>
     </tr> 
 </tbody>
</table>

<table class="table">
 <caption>{{ __('Associated tags') }}</caption>
 <thead>
  <tr>
   <th>{{ __('ID') }}</th>
   <th>{{ __('Name') }}</th>
  </tr>
 </thead>
 <tbody>
   @forelse ($tags as $tag)
   <tr>
    <td><a href="{{ route('tags.show', ['id'=>$tag->id]) }}">{{ $tag->id }}</a>
    <td>{{ $tag->name }}</td>
   </tr>
   @empty
  <tr>
   <td colspan="100">{{ __("No entries") }}</td>
  </tr>   
   @endforelse  
 </tbody>
</table> 

<table class="table">
 <caption>{{ __('Associated objects') }}</caption>
 <thead>
 <tr>
  <th>{{ __('ID') }}</th>
  <th>{{ __('Class') }}</th>
  <th>{{ __('Name') }}</th>
 </tr>
 </thead>
 <tbody>
   @forelse ($objects as $object)
   <tr>
    <td><a href="{{ route('objects.show', ['id'=>$object->id]) }}">{{ $object->id }}</a></td>
    <td><a href="{{ route('classes.show', ['class'=>$object->class]) }}">{{ $object->class_name }}</a></td>
    <td>{{ $object->keyfield }}</td>
   </tr>
   @empty
  <tr>
   <td colspan="100">{{ __("No entries") }}</td>
  </tr>   
   @endforelse  
 </tbody>
</table> 
@endsection
  
