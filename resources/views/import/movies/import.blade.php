@extends('visual::basic.navigation')

@section('title',__('Import movie'))

@section('caption')
{{ __('Import movie') }}
@endsection
  
@section('content')
<form action="{{ route('imports.movies.execimport',['id'=>$id]) }}" method="post">
  @csrf
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