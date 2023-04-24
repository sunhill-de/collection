@extends('visual::basic.navigation')

@section('title',__('add object'))

@section('caption')
 {{ __("Add object of ':classname'",['classname'=>$class->name]) }}
@endsection

@section('content')
@parent
<form method="post" id="addmultiple" name="addmultiple" action="{{ route('objects.execaddmultiple') }}">
 @csrf
 <input type="hidden" name="_class" value="{{ $class->name }}" />
 @foreach ($class->fields as $field)
  <div style="width:33%;">
  <x-collection-input id="{{ $class->name }}" name="{{ $field->name }}" action="add" />
 </div>
 @endforeach

 <div class="field is-grouped">
  <div class="control is-small">
    <button class="button is-link" name="submit">{{ __('submit') }}</button>
  </div>
  <div class="control is-small">
    <button class="button is-link is-light" name="cancel">{{ __('cancel') }}</button>
  </div>
 </div>

</form>
@endsection
  
