@extends('visual::basic.navigation')

@section('title',__('Rotate cameras'))


@section('content')
@parent
 <div class="image container">
 <a href="{{ route('cameras.show_fullscreen',['id'=>$id]); }}">
  <article class="tile is-child box" onclick="window.location = '/Cameras';" >
   <p class="title">{{ __($title) }}</p>
   <div class="content">
	<x-collection-cameras width="800" height="600"  monitor="{{ $id }}" quality="high" />
   </div>
  </article>
 </a>

</div>    

@endsection
  
