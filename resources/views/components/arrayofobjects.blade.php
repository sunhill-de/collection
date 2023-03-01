<div class="field">
 <label class="label">{{ __( $name ) }}</label>
 <div class="columns">
  <div class="control column">
   <label class="label is-size-7">{{__( "Search" ) }}</label>
   <input class="input is-small" type="text" name="input_{{ $name }}" id="input_{{ $name }}" />
   <input type="hidden" name="value_{{ $name }}" id="value_{{ $name }}" />
  </div>
  <div class="control column">
   <label class="label is-size-7">&nbsp;</label>  
   <input class="button is-info is-small" type="button" value="+" onClick="addEntry( '{{ $name }}', true )">
  </div>   
  <div class="column">
   <label class="label is-size-7">{{__( "Current setting" ) }}</label>  
   <div class="dynamic_list" id="list_{{ $name }}">
   @isset($values)
   @foreach($values as $value)
    <div class="control">
     <input type="text" class="input dynamic_entry" readonly name="current_{{ $name }}[]" value="{{ $value->key }}" onclick="removeElement( $(this) )"/>
     <input type="hidden" name="{{ $name }}[]" value="{{ $value->value}}" />
    </div>
   @endforeach
   @endisset
   </div>
  </div>
 </div>
</div>
 <script>
 	$( function() { objectArrayField('{{ $name }}', '{{ $class}}'); } );
 </script>
