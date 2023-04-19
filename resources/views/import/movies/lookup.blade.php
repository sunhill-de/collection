@extends('visual::basic.navigation')

@section('title',__('Lookup movie'))

@section('caption')
{{ __('Lookup movie') }}
@endsection
  
@section('content')
<form action="{{ route('imports.movies.execlookup',['id'=>$id]) }}" method="post">
  @csrf
 <div class="control">
 @foreach($results as $result)
 <input type="radio" name="imdb" id="imdb" value="{{$result['id']}}" @if($loop->first)checked @endif>
<div class="card">
  <div class="card-content">
    <div class="media">
      <div class="media-left">
        <figure class="image is-48x48">
          <img src="{{ $result['image'] }}" alt="Placeholder image">
        </figure>
      </div>
      <div class="media-content">
        <p class="title is-4">{{ $result['title'] }} ({{ $result['year'] }})</p>
        <p class="subtitle is-6">{{ __('length: :length', ['length'=>$result['length']]) }}<br>
        @foreach ($result['genres'] as $genre)
         @if (!$loop->first)*@endif
         {{$genre}}
        @endforeach        
        </p>
      </div>
    </div>

    <div class="content">
      {{ $result['plot'] }}<br>
      {{ __('Cast') }}:
      @foreach($result['cast'] as $cast)
       @if (!$loop->first) * @endif
       <b>{{ $cast['actor'] }}</b> ({{$cast['character']}})
      @endforeach
    </div>
  </div>
 </div> 

 @endforeach
 </div>
 <div class="field is-grouped">
  <div class="control is-small">
    <button class="button is-link" name="submit">{{ __('submit') }}</button>
  </div>
  <div class="control is-small">
    <button class="button is-link is-light" name="cancel">{{ __('cancel') }}</button>
  </div>
 </div>

</form>

@endsection 