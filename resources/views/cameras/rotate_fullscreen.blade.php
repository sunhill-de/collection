@extends('visual::basic.html')

@prepend('js')
  <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
  <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('js/jquery.cycle.all.js') }}"></script>

@section('title',__('Rotate cameras'))

@section('body')
@parent
 <div class="image container is-widescreen">
   <a href="{{ route('cameras.rotate'); }}">
    <div class="cycle-slideshow">
     <img class="diashow_image_small" src="http://192.168.3.1:8081/cgi-bin/nph-zms?scale=0&mode=jpeg&maxfps=30&monitor=1" width="1024" height="800">
     <img class="diashow_image_small" src="http://192.168.3.1:8081/cgi-bin/nph-zms?scale=0&mode=jpeg&maxfps=30&monitor=2" width="1024" height="800">
     <img class="diashow_image_small" src="http://192.168.3.1:8081/cgi-bin/nph-zms?scale=0&mode=jpeg&maxfps=30&monitor=3" width="1024" height="800">
    </div>
   </a>    
  
</div>

 <script>
$(document).ready(function() {
$('.cycle-slideshow').cycle({ 
    fx:      'turnDown', 
    delay:   -4000 
});
});
</script>

@endsection
  
