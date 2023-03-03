<div class="field">
 <label class="label">{{ __( $name ) }}</label>

 <div class="control columns">
  
  <div class="control column">
  <input  class="input is-small" name="input_{{ $name }}" id="input_{{ $name }}"  />
  </div>
  <div class="control column">
  <input  class="input is-small" readonly name="current_{{ $name }}" id="current_{{ $name }}"  @isset($obj_key) value="{{ $obj_key }}" @endisset />
  <input type="hidden" name="{{ $name }}" id="{{ $name }}" @isset($obj_id) value="{{ $obj_id }}" @endisset/>
  </div>
  <div class="control">
     <input class="button is-info is-small" type="button" value="-" onClick="removeEntry( '{{  $name }}', false )">
  </div>
 </div>
</div>
<script>
 	$( function() { objectField('{{ $name }}', '{{ $class}}'); } );
</script>

