@extends('visual::basic.navigation')

@section('title',__('Select classes'))

@push('css')
  <link rel="stylesheet" href="{{ asset('/css/style.min.css') }}" />
@endpush

@section('caption')
{{ __('Select classes') }}
@endsection

@section('content')
@parent
<form method="post" action="">
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

    "plugins": ["dnd", "themes", "state", "json-data", "types", "wholerow", "checkbox"]
}
); 


});
</script>
 <div class="field is-grouped">
  <div class="control is-small">
    <button class="button is-link">{{ __('submit') }}</button>
  </div>
  <div class="control is-small">
    <button class="button is-link is-light">{{ __('cancel') }}</button>
  </div>
 </div>

</form>
@endsection
  

