<ul>
@foreach ($entries as $entry)
<li>
 <div class="level-left">
  <div class="level-item">
   <div class="date_date">{{ $entry->begin_date }}@isset($entry->begin_time) ({{ $entry->begin_time }})@endisset: </div>
  </div>  
  <div class="level-item">
   <div class="date_title">{{ $entry->name }}</div>
  </div>
 </div>  
</li> 
@endforeach
</ul>
