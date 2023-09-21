@extends('visual::basic.navigation')

@section('title',__('Show class'))

@section('caption')
{{ __('Show class') }}
@endsection

@section('content')
@parent
 <table class="table is-bordered is-striped is-hoverable">
 <caption>{{ __("Show collection ':collectionname'", ['collectionname'=>$collectionname]) }}</caption>
 <thead>
  <tr>
   <th>{{ __('Key') }}</th>
   <th>{{ __('Value') }}</th>
  </tr>
 </thead>
 <tbody>
  <tr>
   <td>{{ __('Collection name') }}</td>
   <td>{!! display_variable($collectionname) !!}</td>
  </tr>
  <tr>
   <td>{{ __('Description') }}</td>
   <td>{!! display_variable($description) !!}</td>
  </tr>
  <tr>
   <td>{{ __('Namespace') }}</td>
   <td>{!! display_variable($namespace) !!}</td>
  </tr>
  <tr>
   <td>{{ __('Table name') }}</td>
   <td>{!! display_variable($tablename) !!}</td>
  </tr>
   <td>{{ __('Object count') }}</td>
   <td>{!! display_variable($object_count) !!}</td>
  </tr>
  <tr>
   <td>{{ __('Editable') }}</td>
   <td>{!! display_variable($editable) !!}</td>
  </tr>
  <tr>
   <td>{{ __('Instantiable') }}</td>
   <td>{!! display_variable($instantiable) !!}</td>
  </tr>
 </tbody> 
</table>

 <table class="table is-bordered is-striped is-hoverable">
 <caption>{{ __("Show propeties of collection ':collectionname'", ['collectionname'=>$collectionname]) }}</caption>
 <thead>
  <tr>
   <th>{{ __('Name') }}</th>
   <th>{{ __('Description') }}</th>
   <th>{{ __('Type') }}</th>
   <th>{{ __('Semantic') }}</th>
   <th>{{ __('Unit') }}</th>
   <th>{{ __('Default') }}</th>
   <th>{{ __('Nullable') }}</th>
   <th>{{ __('Displayable') }}</th>
   <th>{{ __('Editable') }}</th>
   <th>{{ __('Group editable') }}</th>
   <th>{{ __('Additional') }}</th>
  </tr>
 </thead>
 <tbody>
@foreach ($properties as $property)
  <tr>
	<td>{{ $property->name }}</td>
	<td>{{ $property->description }}</td>
	<td>{{ $property->type }}</td>
	<td>{{ $property->semantic }}</td>
	<td>{{ $property->unit }}</td>
	<td>{{ $property->default }}</td>
	<td>{!! display_variable($property->nullable) !!}</td>
	<td>{!! display_variable($property->displayable) !!}</td>
	<td>{!! display_variable($property->editable) !!}</td>
	<td>{!! display_variable($property->groupeditable) !!}</td>
	<td>{{ $property->additional }}</td>
  </tr>
@endforeach
 </tbody> 
</table>
<button>   
<a href="{{ route('collection.add',['collection'=> $collectionname]) }}">{{ __('add') }}</a>
</button>
@endsection
  
