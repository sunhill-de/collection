@extends('visual::basic.html')

@prepend('js')
  <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
  <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('js/jquery.cycle.all.js') }}"></script>

@section('title',__($title))

@section('body')
@parent
 <div class="image container is-widescreen">
 <a href="{{ route('cameras.rotate'); }}">
  <article class="tile is-child box" onclick="window.location = '/Cameras';" >
   <p class="title">{{ __($title) }}</p>
   <div class="content">
	<x-collection-cameras width="800" height="600"  monitor="{{ $id }}" quality="high" />
   </div>
  </article>
 </a>  
</div>

@endsection
  
