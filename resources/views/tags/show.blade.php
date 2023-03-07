@extends('visual::basic.navigation')

@section('title',__('Show tag') )

@section('caption')
{{ __('Show tag') }}
@endsection

@section('content')
@parent

<table class="table">
 <tr>
  <th>{{ __('Field') }}</th>
  <th>{{ __('Value') }}</th>
 </tr>
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
  <td>{{ __('Leafable') }}</td>
  <td>{{ $leafable }}</td>
 </tr> 
</table> 
@endsection
  
