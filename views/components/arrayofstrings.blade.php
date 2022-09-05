<div class="inputgroup">
 <fieldset>
 <legend>{{ __( $name ) }}</legend>
 <input type="text" name="__{{ $name }}" id="__{{ $name }}" />
 <input type="button" value="+" onClick="addStrEntry( '{{ $name }}' )">
 <input type="button" value="-" onClick="delStrEntry( '{{ $name }}' )">

 <ul class="selectable" name="_{{ $name }}" id="_{{ $name }}">
  @isset($values)
  @foreach($values as $value)
 <li>{{ $value }}<input type="hidden" name="_{{ $name }}{{ $loop->index+1 }}" value="{{ $value }}"/></li>
  @endforeach
 @endisset
 </ul>

 <input type="hidden" name="_{{$name}}_count" id="_{{$name}}_count" value="@isset($values){{ count($values) }} @else 0 @endisset"/>
 <script>
 	$( function() { stringArrayField('{{ $name }}', '{{ $class}}'); } );
 </script>
 </fieldset>	     
</div>
