@extends('visual::basic.navigation')

@section('title',__('Show attribute') )

@section('caption')
{{ __('Show attribute') }}
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
      <td>{{ __('Id') }}</td>
      <td>{{ $id }}</td>
     </tr>
     <tr>
      <td>{{ __('Name') }}</td>
      <td>{{ $name }}</td>
     </tr>
     <tr>
      <td>{{ __('Type') }}</td>
      <td>{{ $type }}</td>
     </tr>
     <tr>
      <td>{{ __('Property') }}</td>
      <td>{{ $property }}</td>
     </tr>
      <tr>
      <td>{{ __('Allowed classes') }}</td>
      <td>{{ $allowed_classes }}</td>
     </tr> 
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
  
