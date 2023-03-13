<div class="control">
 <label class="label">{{ __( "Attributes" ) }}</label>
 <div class="columns control">
  <div class="control column">
   <label class="label is-size-7">{{__( "Available" ) }}</label>
   <select name="avaiable" id="avaiable">
    @foreach ($avail_attr as $attribute)
    <option value="{{ $attribute->name }}">{{ $attribute->name }}</option>
    @endforeach
   </select>
  </div>
   <div class="control column">
   <label class="label is-size-7">&nbsp;</label>
     <input class="button is-info is-small" type="button" value="+" onClick="addAttribute()">
  </div>
  <div class="control column" name="current_attributes" id="current_attributes">
   @isset($cur_attr)
   @foreach($cur_attr as $attribute)
    <div class="control"><label class="label is-size-7">{{ $attribute->name }}</label>
    @switch ($attribute->type)
	 @case("int")
	<input name="{{ $attribute->name }}" type="number" value="{{ $attribute->value }}"/> @break;
	@case("char")
    <input name="{{ $attribute->name }}" type="text"  value="{{ $attribute->value }}"/> @break;
	@case("float")			
	<input name="{{ $attribute->name }}" type="number"  value="{{ $attribute->value }}"/> @break;
	@case("text")
	<textarea name="{{ $attribute->name }}">{{ $attribute->value }}</textarea> @break;    
    @endswitch
    </div>
   @endforeach
   @endisset
  </div>
 </div>
</div>
