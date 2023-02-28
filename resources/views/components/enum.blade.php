<div class="field">
 <label class="label">{{__($name)}}</label>
 <div class="control">
  <div class="select">
   <select class="is-small" name="{{$name}}" id="{{$name}}">
    <option value="" class="is-small">(leer)</option>
    @foreach($entries as $value)
    <option value="{{$value}}" @if (isset($selected) && ($selected == $value)) selected @endif>{{__($value)}}</option>
    @endforeach
   </select>
  </div>
 </div>
</div>
