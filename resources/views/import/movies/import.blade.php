@extends('visual::basic.navigation')

@section('title',__('Import movie'))

@section('caption')
{{ __('Import movie') }}
@endsection
  
@section('content')
<form action="{{ route('imports.movies.execimport',['id'=>$id]) }}" method="post">
  @csrf
  <div class="field-group">
  <div class="field is-inline-block-desktop">
   <label class="label">{{__('Name')}}</label>
   <div class="control">
    <input class="input is-small @isset( $error_title ) is-danger @endisset" type="text" name="title" id="title" value="{{ $movie->title }}" />
    @isset( $error_name )
     <p class="help is-danger">{{ $error_title }}</p>  
    @endisset
   </div>
  </div>
  
  <div class="field is-inline-block-desktop">
   <label class="label">{{__('Original name')}}</label>
   <div class="control">
    <input class="input is-small @isset( $error_original_title ) is-danger @endisset" type="text" name="original_title" id="original_title" value="{{ $movie->original_title }}" />
    @isset( $error_name )
     <p class="help is-danger">{{ $error_original_title }}</p>  
    @endisset
   </div>
  </div>

 <div class="field is-inline-block-desktop">
  <label class="label">{{__('Search name')}}</label>
  <div class="control">
   <input class="input is-small @isset( $error_search_name ) is-danger @endisset" type="text" name="search_name" id="search_name" value="{{ $movie->search_name }}" />
   @isset( $error_name )
    <p class="help is-danger">{{ $error_name }}</p>  
   @endisset
  </div>
 </div>

 <div class="field is-inline-block-desktop">
  <label class="label">{{__('Release date')}}</label>
  <div class="control">
   <input class="input is-small @isset( $error_release_date ) is-danger @endisset" type="date" name="release_date" id="release_date" value="{{ $movie->release_date }}" />
   @isset( $error_release_date )
    <p class="help is-danger">{{ $error_release_date }}</p>  
   @endisset
  </div>
 </div>
 
 <div class="field is-inline-block-desktop">
  <label class="label">{{__('IMDb ID')}}</label>
  <div class="control">
   <input class="input is-small @isset( $error_imdb ) is-danger @endisset" type="text" name="imdb" id="imdb" value="{{ $movie->imdb_id }}" />
   @isset( $error_imdb )
    <p class="help is-danger">{{ $error_imdb }}</p>  
   @endisset
  </div>
 </div> 
 </div>

 <div class="field is-inline-block-desktop">
  <label class="label">{{__('TMDb ID')}}</label>
  <div class="control">
   <input class="input is-small @isset( $error_tmdb ) is-danger @endisset" type="text" name="tmdb" id="tmdb" value="{{ $movie->tmdb_id }}" />
   @isset( $error_tmdb )
    <p class="help is-danger">{{ $error_tmdb }}</p>  
   @endisset
  </div>
 </div> 

 <div class="field is-inline-block-desktop">
  <label class="label">{{__('Length')}}</label>
  <div class="control">
   <input class="input is-small @isset( $error_length ) is-danger @endisset" type="number" name="lenght" id="length" value="{{ $movie->length }}" />
   @isset( $error_length )
    <p class="help is-danger">{{ $error_length }}</p>  
   @endisset
  </div>
 </div> 

 @foreach($movie->reference_tree as $key => $values)
 <div class="field">
 {{$key}}
 <table class="table">
  <tr>
   @foreach ($values[0] as $key => $value)
   <th>{{ $key }}</th>
   @endforeach
   </tr>
   @foreach ($values as $row)
   <tr>
   @foreach ($row as $key => $col)
   <td>
@if(empty($row->getExternalReference()))
   <input type="text" value="{{ $col }}" name="{{ $key }}_{{ $row->getInternalReference() }}" />
@else
	{{ $col }}
@endif   
   </td>
   @endforeach
   </tr>
   @endforeach
 </table>
</div> 
 @endforeach
 <div class="field">
  <label class="label" for="plot">{{ __('Plot') }}</label>	
  <textarea name="plot" id="plot" rows="8" cols="80">{{ $movie->plot }}</textarea>
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