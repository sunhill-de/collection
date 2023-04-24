@extends('visual::basic.navigation')

@section('title',__('Lookup movie'))

@section('caption')
{{ __('Lookup movie') }}
@endsection
  
@section('content')
<form action="{{ route('imports.movies.execlookup',['id'=>$id]) }}" method="post">
  @csrf
 <div class="control">
 @foreach($results as $id => $result)
 <input type="hidden" name="imdb" id="imdb" value="{{$result->imdb_id}}"/>
 <input type="radio" name="tmdb" id="tmdb" value="{{$result->id}}" @if($loop->first)checked @endif>
 
<div class="card">
  <div class="card-content">
    <div class="media">
      <div class="media-left">
        <figure class="image is-48x48">
          @if(isset($result->posters(300)[0]))
          <img src="{{ $result->posters(300)[0]->file_path }}" alt="Placeholder image">
          @endif
        </figure>
      </div>
      <div class="media-content">
        <p class="title is-4">{{ $result->title }} ({{ explode('-',$result->release_date)[0] }})</p>
        <p class="subtitle is-6">{{ __('length: :length', ['length'=>$result->runtime]) }}<br>
        @foreach ($result->genres as $genre)
         @if (!$loop->first)*@endif
         {{$genre->name}}
        @endforeach        
        </p>
      </div>
    </div>

    <div class="content">
      {{ $result->overview }}<br>
      {{ __('Cast') }}:
      @if(isset($result->casts()['cast']))
      @foreach(array_slice($result->casts()['cast'],0,5) as $cast)
       @if (!$loop->first) * @endif
       <b>{{ $cast->name }}</b> ({{$cast->character}})
      @endforeach
      @endif
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