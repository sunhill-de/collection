@extends('visual::basic.navigation')

@section('title',__('Show object'))

@section('caption')
{{ __('Show object') }}
@endsection

@section('content')
@parent
<div class="list">
    <table class="table is-striped is-hoverable">
     <caption>{{ __('Fields') }}</caption>
     <tr>
      <th>{{ __('class') }}</th>
      <th>{{ __('Name') }}</th>
      <th>{{ __('Type') }}</th>
      <th>{{ __('Description') }}</th>
      <th>{{ __('Value') }}</th>
      <th>{{ __('Displayable') }}</th>
      <th>{{ __('Editable') }}</th>
      <th>{{ __('Groupeditable') }}</th>
     </tr>
     <tr>
      <td>object</td>
      <td>{{ __('ID') }}</td>
      <td>{{ __('Integer') }}</td>
      <td>{{ __('ID of this Object') }}</td>
      <td>{{ $id }}</td>
      <td>{{ __('Yes') }}</td>
      <td>{{ __('No') }}</td>
      <td>{{ __('No') }}</td>
     </tr>
     @forelse ($fields as $field)
      <tr>
       <td>{{ $field->class }}</td>
       <td>{{ $field->name }}</td>
       <td>{{ $field->type }}</td>
       <td>{{ $field->description }}</td>
       <td><b>{{ $field->value }}</b></td>
       <td>@if ($field->displayable)<div class="yes">{{ __('Yes') }}</div>@else<div class="no">{{ __('No') }}</div>@endif</td>  
       <td>@if ($field->editable)<div class="yes">{{ __('Yes') }}</div>@else<div class="no">{{ __('No') }}</div>@endif</td>  
       <td>@if ($field->groupeditable)<div class="yes">{{ __('Yes') }}</div>@else<div class="no">{{ __('No') }}</div>@endif</td>  
      </tr>
     @empty
     <tr><td colspan="100">{{ __('No fields set') }}</td></tr>
     @endforelse
    </table>
    
    <table class="table">
     <caption>{{ __('Tags') }}</caption>
     <thead>
      <tr><th>{{ __('Tag') }}</th></tr>
     </thead>
     <tbody>
     @forelse ($tags as $tag)
      <tr><td>{{ $tag->name }}</td></tr>
     @empty
      <tr><td>{{ __('No tags set') }}</td></tr>
     @endforelse      
     </tbody>
    </table>

    <table class="table">
     <caption>{{ __('Attributes') }}</caption>
     <thead>
      <tr>
       <th>{{ __('Name') }}</th>
       <th>{{ __('Type') }}</th>
       <th>{{ __('Value') }}</th>
      </tr>	
     </thead>
     <tbody>
     @forelse ($attributes as $attribute)
      <tr>
       <td>{{ $attribute->name }}</td>
       <td>{{ $attribute->type }}</td>
       <td>{{ $attribute->value }}</td>
      </tr>
     @empty
      <tr><td colspan="100">{{ __('No attributes set') }}</td></tr>
     @endforelse      
     </tbody>
    </table>
     <div class="field is-grouped">
  <div class="control">
    <a href="{{ route('objects.edit',['id'=>$id]) }}" class="button is-link">Edit</a>
  </div>
  <div class="control">
    <a href="{{ route('objects.delete',['id'=>$id]) }}" class="is-danger button is-link">Delete</a>
  </div>
 </div>
    
</div>
@endsection
  
