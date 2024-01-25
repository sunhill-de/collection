@foreach ($dates as $date)
<h3>{{ $date->date }}</h3>
<ul>
@foreach ($date->entries as $entry)
<li>
 <div class="level-left">
  <div class="level-item">
   <div class="date_title">{{ $entry->name }}</div>
  </div>
  <div class="level-item">
   <div class="date_title">@isset($entry->time){{ $entry->time }}@else &nbsp;@endisset</div>
  </div>
 </div>  
</li> 
@endforeach
</ul>
@endforeach
