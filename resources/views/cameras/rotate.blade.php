@extends('visual::basic.navigation')

@section('title',__('Rotate cameras'))

@section('caption')
{{ __('Rotate cameras') }}
@endsection

@section('content')
@parent
 <div class="image container">
 <a href="{{ route('cameras.rotate_fullscreen'); }}">
    <div class="cycle-slideshow">
     <img class="diashow_image_small" src="http://192.168.3.1:8081/cgi-bin/nph-zms?scale=0&mode=jpeg&maxfps=30&monitor=1" width="900" height="600">
     <img class="diashow_image_small" src="http://192.168.3.1:8081/cgi-bin/nph-zms?scale=0&mode=jpeg&maxfps=30&monitor=2" width="900" height="600">
     <img class="diashow_image_small" src="http://192.168.3.1:8081/cgi-bin/nph-zms?scale=0&mode=jpeg&maxfps=30&monitor=3" width="900" height="600">
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
  
