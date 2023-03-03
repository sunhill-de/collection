@extends('visual::basic.navigation')

@section('title',__('Import file'))

@section('caption')
{{ __('Import file') }}
@endsection
  
@section('content')
<form action="{{ route('imports.execfile') }}" method="post">
 @csrf
 
 <div class="field">
 <label class="label">{{__('File')}}</label>
 <div class="control">
  <input class="input is-small" type="file" name="file" id="file"/>
 </div>
</div>
 
 <div class="field">
 <label class="label">{{__('Filter')}}</label>
 <div class="control">
  <select name="filter" id="filter">
   <option value="0">{{ __('Auto detect') }}</option>
   @foreach (\Sunhill\Collection\Facades\Imports::getFilters() as $name => $filter)
   <option value="{{ $name }}">{{ $name }}</option>
   @endforeach  
  </select>
 </div>
</div>
 
 <div class="field is-grouped">
  <div class="control is-small">
    <button class="button is-link">{{ __('submit') }}</button>    
  </div>
  <div class="control is-small">
    <button class="button is-link is-light">{{ __('cancel') }}</button>
  </div>
 </div>
</form>
@endsection 