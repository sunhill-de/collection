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
  <input class="input is-small" type="text" name="name" id="name" @isset($name)) value="{{ $name }}" @endisset />
 </div>
</div>
 <div class="field">
 <label class="label">{{__('Type')}}</label>
 <div class="control">
  <div class="select">
  <select name="type" class="input is-small">
   <option value="int" @isset($type) @if ($type == 'int') selected @endif @endisset>{{ __('Integer') }}</option>
   <option value="char" @isset($type) @if ($type == 'char') selected @endif @endisset>{{ __('Char') }}</option>
   <option value="float" @isset($type) @if ($type == 'float') selected @endif @endisset>{{ __('Float') }}</option>
   <option value="text" @isset($type) @if ($type == 'text') selected @endif @endisset>{{ __('Text') }}</option>
  </select>
  </div>
 </div>
</div>
<div class="field">
 <label class="label">{{ __( 'Allowed classes' ) }}</label>
 <div class="columns">
  <div class="control column">
   <label class="label is-size-7">{{__( "Search" ) }}</label>
   <input class="input is-small" type="text" name="input_allowedclasses" id="input_allowedclasses" />
  </div> 
  <div class="control column">
   <label class="label is-size-7">&nbsp;</label>  
   <input class="button is-info is-small" type="button" value="+" onClick="addEntry( 'allowedclasses', false )">
  </div>
  <div class="column">
   <label class="label is-size-7">{{__( "Current setting" ) }}</label>  
   <div class="dynamic_list" id="list_allowedclasses">
   @isset($classes)
   @foreach($classes as $value)
    <div class="control">
     <input type="text" class="input is-small dynamic_entry" readonly name="allowedclasses[]" value="{{ $value }}"  onclick="removeElement( $(this) )"/>
    </div>
   @endforeach
   @endisset
    </div>
   </div>
 </div>
</div>

<script>
 	$( function() { classSelectField('allowedclasses', ''); } );
</script>

 <div class="field is-grouped">
  <div class="control">
    <button class="button is-link is-small">{{ __('submit') }}</button>
  </div>
  <div class="control">
    <button class="button is-link is-light is-small">{{ __('cancel') }}</button>
  </div>
 </div>
</form>

@endsection
  
