@extends('visual::basic.navigation')

@section('title',__('Edit movie'))

@section('caption')
{{ __('Edit movie') }}
@endsection
  
@section('content')
<form action="{{ route('imports.movies.execedit',['id'=>$id]) }}" method="post">
  @csrf
  <input type="hidden" name="return_to" value="{{ $return_to }}" />
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
 <label class="label">{{__('Source')}}</label>
 <div class="control">
  <input class="input is-small @isset( $error_name ) is-danger @endisset" type="text" name="source" id="source" @isset($source)) value="{{ $source }}" @endisset />
  @isset( $error_name )
    <p class="help is-danger">{{ $error_name }}</p>  
  @endisset
 </div>
</div>

 <div class="field">
 <label class="label">{{__('Source ID')}}</label>
 <div class="control">
  <input class="input is-small @isset( $error_name ) is-danger @endisset" type="text" name="source_id" id="source_id" @isset($source_id)) value="{{ $source_id }}" @endisset />
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

 <div class="field">
 <label class="label">{{__('Type')}}</label>
 <div class="control">
  <select class="input is-small" name="type" id="type" onchange="testepisode()">
   <option value="movie" @selected($type=='movie')>{{ __('Movie') }}</option>
   <option value="series" @selected($type=='series')>{{ __('Series') }}</option>
   <option value="episode" @selected($type=='episode')>{{ __('Episode') }}</option>
  </select>
  @isset( $error_name )
    <p class="help is-danger">{{ $error_name }}</p>  
  @endisset
 </div>
</div>
 
 <div id="series_info">
 <div class="field">
 <label class="label">{{__('Series')}}</label>
 <div class="control">
  <input class="input is-small @isset( $error_name ) is-danger @endisset" type="text" name="series" id="series" @isset($series)) value="{{ $series }}" @endisset />
  <input type="hidden" name="series_id" id="series_id" @isset($series_id)) value="{{ $series_id }}" @endisset>
  @isset( $error_name )
    <p class="help is-danger">{{ $error_name }}</p>  
  @endisset
 </div>
</div>

 <div class="field">
 <label class="label">{{__('Season')}}</label>
 <div class="control">
  <input class="input is-small @isset( $error_name ) is-danger @endisset" type="text" name="season" id="season" @isset($season)) value="{{ $season }}" @endisset />
  @isset( $error_name )
    <p class="help is-danger">{{ $error_name }}</p>  
  @endisset
 </div>
</div>

 <div class="field">
 <label class="label">{{__('Episode')}}</label>
 <div class="control">
  <input class="input is-small @isset( $error_name ) is-danger @endisset" type="text" name="episode" id="episode" @isset($episode)) value="{{ $episode }}" @endisset />
  @isset( $error_name )
    <p class="help is-danger">{{ $error_name }}</p>  
  @endisset
 </div>
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
 <script>
 	$( function() { 
 		testepisode() 
 	
 		$("#series").autocomplete({
			source: function( request, response) {
				$.ajax({
					url:"{{ asset("/ajax/searchImportSeries") }}",
					type:"get",
					dataType:"json",
					data: { 
						search: request.term 
					},
					success: function( data ) {
						response( data );
				}	
				});
			},
			select: function( event, ui ) {
				$("#series").val(ui.item.label);
				$("#series_id").val(ui.item.id);
				return false;
			},
			focus: function( event, ui ) {
				$("#series").val(ui.item.label);
				$("#series_id").val(ui.item.id);
				return false;
			}
		})
 	
 	} );
 	function testepisode() {
 		if ($("#type").val() == "episode") {
 	  		$("#series_info").show();
 		} else {
 	  		$("#series_info").hide();
    	} 	  
 	}
 </script>

</form>

@endsection 