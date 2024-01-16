@extends('visual::basic.navigation')

@section('title')
{{ __("Show news article") }}
@endsection

@section('content')
@parent
<article class="news">
 <div class="columns">
  <div class="column is-narrow">
   <img class="news-icon" src="http://192.168.3.3:8888/favicons/{!! $icon !!}">
  </div>
  <div class="column">
   <h1>{{ $title }}</h1>
  </div>
  <div class="column is-narrow">
   {{ $stamp }}
  </div>
 </div>
 <div class="news-content">
 {!! $content !!}}
 </div>
</article>
@endsection