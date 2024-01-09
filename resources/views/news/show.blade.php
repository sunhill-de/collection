@extends('visual::basic.navigation')

@section('title')
{{ __("Show news article") }}
@endsection

@section('content')
@parent
<article class="news">
 <div class="columns">
  <div class="column is-narrow">
   <img src="http://192.168.3.3:8888/favicons/{{ $entry->symbol }}" width="100px" height="100px">
  </div>
  <div class="column">
   <h1>{{ $entry->headline }}</h1>
  </div>
  <div class="column is-narrow">
   {{ $entry->stamp }}
  </div>
 </div>
</article>
@endsection