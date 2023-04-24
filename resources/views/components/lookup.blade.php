<input type="hidden" name="{{ $field_name }}" id="{{ $field_name }}" value="{{ $field_value }}" />
<input type="text" name="{{ $field_lookup }}" id="{{ $field_lookup }}" value="{{ $field_lookup_value }}" />
<script>
 	$( function() { {{ $lookup_method }}("{{ $field_name }}", "{{ $field_lookup }}", "{{ $target }}"); } );
</script>
