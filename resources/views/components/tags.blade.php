<div class="field">
 <label class="label">{{ __( "Tags" ) }}</label>
 <div class="columns"> 
  <div class="control column">
   <label class="label is-size-7">{{__( "Search" ) }}</label>
   <input class="input is-small" type="text" name="input_tags" id="input_tags" />
  </div>
  <div class="control column">
   <label class="label is-size-7">&nbsp;</label>
   <input class="button is-info is-small" type="button" value="+" onClick="addEntry( 'tags', false )">
  </div>
  <div class="column">
   <label class="label is-size-7">{{__( "Current setting" ) }}</label>  
   <div class="dynamic_list" id="list_{{ $name }}">
   @isset($values)
   @foreach($values as $value)
    <div class="control">
     <input type="text" class="input is-small dynamic_entry" readonly name="tags[]" value="{{ $value }}"/>
    </div>
   @endforeach
   @endisset 
   </div>
  </div> 
 </div>	     
</div>

<script>
 	$( function() { tags('{{ $class}}'); } );
</script>
