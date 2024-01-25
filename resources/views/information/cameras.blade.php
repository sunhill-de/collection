@if ($monitor == 0)
<div class="cycle-slideshow">
 @foreach ($cameras as $camera)
 <img class="diashow_image_small" src="{{ $camera->url }}" width="{{ $width }}" height="{{ $height }}"> 
 @endforeach
</div>
 <script>
$(document).ready(function() {
 $(".cycle-slideshow").cycle();
});
</script>
@else
 <img class="diashow_image_small" src="{{ $url }}" width="{{ $width }}" height="{{ $height }}"> 
@endif
