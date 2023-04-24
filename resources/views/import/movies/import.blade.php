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
    <input class="input is-small @isset( $error_title ) is-danger @endisset" type="text" name="title" id="title" @isset($movie->title)) value="{{ $movie->title }}" @endisset />
    @isset( $error_name )
     <p class="help is-danger">{{ $error_title }}</p>  
    @endisset
   </div>
  </div>
  
  <div class="field is-inline-block-desktop">
   <label class="label">{{__('Original name')}}</label>
   <div class="control">
    <input class="input is-small @isset( $error_original_title ) is-danger @endisset" type="text" name="original_title" id="original_title" @isset($movie->original_title)) value="{{ $movie->original_title }}" @endisset />
    @isset( $error_name )
     <p class="help is-danger">{{ $error_original_title }}</p>  
    @endisset
   </div>
  </div>

 <div class="field is-inline-block-desktop">
  <label class="label">{{__('Search name')}}</label>
  <div class="control">
   <input class="input is-small @isset( $error_search_name ) is-danger @endisset" type="text" name="search_name" id="search_name" @isset($movie->search_name)) value="{{ $movie->search_name }}" @endisset />
   @isset( $error_name )
    <p class="help is-danger">{{ $error_name }}</p>  
   @endisset
  </div>
 </div>

 <div class="field is-inline-block-desktop">
  <label class="label">{{__('Release date')}}</label>
  <div class="control">
   <input class="input is-small @isset( $error_release_date ) is-danger @endisset" type="date" name="release_date" id="release_date" @isset($movie->release_date)) value="{{ $movie->release_date }}" @endisset />
   @isset( $error_release_date )
    <p class="help is-danger">{{ $error_release_date }}</p>  
   @endisset
  </div>
 </div>
 
 <div class="field is-inline-block-desktop">
  <label class="label">{{__('Length')}}</label>
  <div class="control">
   <input class="input is-small @isset( $error_length ) is-danger @endisset" type="number" name="release_date" id="release_date" @isset($movie->length)) value="{{ $movie->length }}" @endisset />
   @isset( $error_length )
    <p class="help is-danger">{{ $error_length }}</p>  
   @endisset
  </div>
 </div> 
 </div>
  
 <div class="field">
  <label class="label" for="plot">{{ __('Plot') }}</label>	
  <textarea name="plot" id="plot">{{ $movie->plot }}</textarea>
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