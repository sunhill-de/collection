@extends('visual::basic.navigation')

@section('title',__('Show collection'))

@section('caption')
{{ __('Show collection') }}
@endsection

@section('content')
@parent
<div class="list">
    <table class="table is-striped is-hoverable">
     <caption>{{ __('Fields') }}</caption>
     <tr>
      <th>{{ __('Name') }}</th>
      <th>{{ __('Value') }}</th>
     </tr>
     @forelse ($fields as $field)
      <tr>
       <td>{{ $field->name }}</td>
       <td><b>{{ $field->value }}</b></td>
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
    <a href="{{ route('collection.edit',['id'=>$id]) }}" class="button is-link">Edit</a>
  </div>
  <div class="control">
    <a href="{{ route('collection.delete',['id'=>$id]) }}" class="is-danger button is-link">Delete</a>
  </div>
 </div>
    
</div>
@endsection
  
