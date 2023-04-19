@extends('visual::basic.navigation')

@section('title',__('Edit movie'))

@section('caption')
{{ __('Edit movie') }}
@endsection
  
@section('content')
<form action="{{ route('imports.movies.execadd') }}" method="post">
  @csrf
  <div class="field">
 <label class="label">{{__('Name')}}</label>
 <div class="control">
  <input class="input is-small @isset( $error_name ) is-danger @endisset" type="text" name="title" id="title" @isset($title)) value="{{ $title }}" @endisset />
  @isset( $error_name )
    <p class="help is-danger">{{ $error_name }}</p>  
  @endisset
 </div>
</div>
 
 <div class="field">
 <label class="label">{{__('IMDb ID')}}</label>
 <div class="control">
  <input class="input is-small @isset( $error_name ) is-danger @endisset" type="text" name="imdb_id" id="imdb_id" @isset($imdb_id)) value="{{ $imdb_id }}" @endisset />
  @isset( $error_name )
    <p class="help is-danger">{{ $error_name }}</p>  
  @endisset
 </div>
</div>

 <div class="field">
 <label class="label">{{__('Object ID')}}</label>
 <div class="control">
  <input class="input is-small @isset( $error_name ) is-danger @endisset" type="text" name="object_id" id="object_id" @isset($object_id)) value="{{ $object_id }}" @endisset />
  @isset( $error_name )
    <p class="help is-danger">{{ $error_name }}</p>  
  @endisset
 </div>
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