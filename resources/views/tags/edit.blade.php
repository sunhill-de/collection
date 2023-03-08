@extends('visual::basic.navigation')

@section('title',$title)

@section('caption')
{{ $title }}
@endsection

@section('content')
@parent
<form method="post" id="add" name="add" action="{{ $action }}">
 @csrf
 <div class="field">
 <label class="label">{{__('Name')}}</label>
 <div class="control">
  <input class="input is-small @isset( $error_name ) is-danger @endisset" type="text" name="name" id="name" @isset($name)) value="{{ $name }}" @endisset />
  @isset( $error_name )
    <p class="help is-danger">{{ $error_name }}</p>  
  @endisset
 </div>
</div>
 <div class="field">
 <label class="label">{{__('Parent')}}</label>
 <div class="control">
  <input class="input is-small" type="text" name="input_parent" id="input_parent" @isset($input_parent)) value="{{ $input_parent }}" @endisset />
  <input type="hidden" name="value_parent" id="value_parent" @isset($value_parent)) value="{{ $value_parent }}" @endisset />
 </div>
</div>
<div class="control">
 <div class="columns">
  <div class="column"><label class="label" for="leafable">{{ __('leafable') }}</label></div>
  <div class="column"><input type="checkbox" name="leafable" id="leafable" @if($leafable) checked @endif></div>
 </div>
</div>
 <div class="field is-grouped">
  <div class="control">
    <button class="button is-link is-small">{{ __('submit') }}</button>
  </div>
  <div class="control">
    <button class="button is-link is-light is-small">{{ __('cancel') }}</button>
  </div>
 </div>
</form>

<script>
 	$( function() { tagField('parent', ''); } );
</script>

@endsection
  
