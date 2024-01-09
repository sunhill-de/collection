@extends('visual::basic.tile')

@section('tilecaption')
{{ __("News") }}
@endsection

@section('tilebody')
@parent
    <div class="scroll-frame" id="scroll-frame">
     <ul class="data-list scroll-content" data-autoscroll>  
@foreach ($newsentries as $entry)
  <li class="scroll-item"><a href="{{ $entry->id }}">{{ $entry->headline }}</a></li>  
@endforeach
    </ul>
  </div>
@endsection