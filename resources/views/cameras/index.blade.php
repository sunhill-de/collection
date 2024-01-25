@extends('visual::basic.navigation')

@section('title')
Kameras Hauptseite
@endsection

@section('content')
@parent
<div class="columns is-multiline">
  @foreach ($cameras as $camera)
  <article class="column is-one-third">
   <p class="title">{{ $camera->title }}</p>
   <div class="content">
	<x-collection-cameras width="350" height="296"  monitor="{{ $camera->id}}" quality="high" />
   </div>
  </article>
  @endforeach
</div>
@endsection
