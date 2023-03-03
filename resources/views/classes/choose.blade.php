@extends('visual::basic.navigation')

@section('title',__('Choose class'))

@push('css')
  <link rel="stylesheet" href="{{ asset('/css/style.min.css') }}" />
@endpush

@section('caption')
{{ __('Show class') }}
@endsection

@section('content')
@parent
<div id="classtree"></div>
<script>
$(function() { $('#classtree').jstree(
{
 'core' : {
        "themes": {
            "responsive": false,
			"stripes": true
        },
        'data': {
            "url": function(node) {
				if (node.id === "#") {
					return "{{ asset("/ajax/getClass/object") }}";
				} else {
					return "{{ asset("/ajax/getClass/") }}/"+node.id; 					
				}             
            },
			"data-type": "json",
            "data": function(node) {
                return {
                    "id": node.id
                };
			}
 	    }
    },
    "types": {
        "default": {
            "icon": "fa fa-folder text-primary"
        },
        "file": {
            "icon": "fa fa-file  text-primary"
        }
    },
    "state": {
        "key": "demo3"
    },
    "themes": {
		"theme": "default",
		"dots": true,
		"icons": true
	},

    "plugins": ["dnd", "themes", "state", "json-data", "types", "wholerow"]
}
); 

$("#classtree").on('activate_node.jstree', function (e,data) {
	
	if (this.first) {
		var id = data.instance.get_node(data.selected).id;
		location.href = '{{ $target }}/'+id;
	} else {
       this.first = 1;	
	}		
});;

});
</script>
@endsection
  
