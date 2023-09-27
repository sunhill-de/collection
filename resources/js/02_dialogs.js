  $( function() {
    $( document ).tooltip();
  } );
  
function removeElement( caller ) {
	caller.parent().remove();
}
 
function addAttribute() {
	var attribute_name = $("#avaiable").val();
	$.get("{{ asset("/ajax/") }}/getAttributeType/"+attribute_name , function(data) {
		var append = '<div class="control"><label class="label is-size-7">'+attribute_name+'</label>';
		switch (data) {
			case "int":
				append += '<input name="'+attribute_name+'" type="number" />'; break;
		    case "char":
				append += '<input name="'+attribute_name+'" type="text" />'; break;
			case "float":			
				append += '<input name="'+attribute_name+'" type="number" />'; break;
			case "text":
				append += '<textarea name="'+attribute_name+'"></textarea>'; break;
			default: 
				alert( data );	
		}
		append += "</div>";
		$("#current_attributes").append(append);
	})
} 
