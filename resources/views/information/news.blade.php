@extends('visual::basic.tile')

@section('tilecaption')
{{ __("News") }}
@endsection

@section('tilebody')
@parent
    <div class="scroll-frame" id="scroll-frame">
     <ul class="data-list scroll-content" data-autoscroll>  
@foreach ($newsentries as $entry)
  <li class="scroll-item">
   <div class="columns">
    <div class="column is-narrow">
	 <img src="http://192.168.3.3:8888/favicons/{{ $entry->symbol }}" width="30px" height="30px">
    </div>
    <div class="column">
   <a href="{{ $entry->id }}">
    {{ $entry->headline }}
    </a>
    </div>
   </div>
  </li>  
@endforeach
    </ul>
  </div>
@endsection