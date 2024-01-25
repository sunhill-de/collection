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
  <article class="tile is-child box" onclick="window.location = '/Cameras';" >
   <p class="title">{{ __('Rotate all cameras') }}</p>
   <div class="content">
	<x-collection-cameras width="800" height="600"  monitor="0" quality="high" />
   </div>
  </article>
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
  
