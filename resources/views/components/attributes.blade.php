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
   <div class="control column" name="curren_attributes" id="current_attributes">
  </div>
 </div>
</div>
