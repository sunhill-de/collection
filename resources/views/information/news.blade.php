@extends('visual::basic.tile')

@section('tilecaption')
{{ __("News") }}
@endsection

@section('tilebody')
@parent
    <div class="scroll-frame" id="scroll-frame">
     <ul class="data-list scroll-content" id="news">  
    </ul>
  </div>
  <script>
 	
 	function initializeNews()
 	{
 		let current_index = 0;
 		
	function update_news()
	{
		$.get("{{ asset("/ajax/") }}/news" , function(data) {
		const json_data = JSON.parse(data);
		let append_head = '';		
		let append_tail = '';		
		
		function doAppend(entry, index) {
			if (index > current_index) {
				append_head += '<li class="scroll-item"><div class="columns"><div class="column is-narrow">'+
		                       '<img src="http://192.168.3.3:8888/favicons/'+entry.icon+'" width="30px" height="30px">'+
		                       '</div><div class="column"><a href="/Information/News/Show/'+entry.id+'">'+
		                       entry.title+'</a></div></div></li>';		                       
		    } else {
				append_tail += '<li class="scroll-item"><div class="columns"><div class="column is-narrow">'+
		                       '<img src="http://192.168.3.3:8888/favicons/'+entry.icon+'" width="30px" height="30px">'+
		                       '</div><div class="column"><a href="/Information/News/Show/'+entry.id+'">'+
		                       entry.title+'</a></div></div></li>';		                       
		    }
		}
		
		json_data.forEach(doAppend); 
	    $("#news").empty();
	    $("#news").append(append_head+append_tail);
	    if (current_index++ > json_data.length) {
	    	current_index = 0;
	    }
	    console.log(current_index);
	  } );	  
	}	
		
	update_news();
		window.setInterval(function() {
		  update_news();
		},2000);  
	}
	$( function() {
		initializeNews(); 
	} );
  </script>
@endsection