@extends('visual::basic.hamburger')

@push('css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endpush

@prepend('js')
  <script src="/js/jquery-3.6.1.min.js"></script>
  <script src="/js/jquery-ui.min.js"></script>
  <script src="/js/sunhill.js"></script>
  <script src="/js/jstree.min.js"></script>
  <script src="/js/jquery.cycle.all.js"></script>
@endpush

@section('body')

@parent
<div class="page">
 <!-- Main navigation -->
 @isset($nav_1)
 <nav role="navigation" class="main-navigation">
  <div class="navigation-tile">
   <a href="/" id="Home">Home</a>
  </div>
  @foreach ($nav_1 as $entry)
  <div class="navigation-tile">
   <a href="{{ $entry->link }}" id="{{ $entry->name }}">{{ $entry->display_name }}</a>
  </div>
  @endforeach
 </nav>
 @endif
 <div class="optional-part">
  <!-- Subnavigation -->
  @isset($nav_2)
  <nav role="navigation" class="sub-navigation">
   @foreach ($nav_2 as $entry)
   <div class="navigation-tile">
    <a href="{{ $entry->link }}" id="{{ $entry->name }}">{{ $entry->display_name }}</a>
   </div> 
   @endforeach
  </nav>
  @endif
  <!--  Dropdown menu -->
  @if (isset($nav_3) && !empty($nav_3))
  <nav class="navbar" role="navigation" aria-label="dropdown navigation">
   @foreach ($nav_3 as $entry)
   <div class="navbar-item has-dropdown is-hoverable">
    <a class="navbar-link" href="{{ $entry->link }}">{{ $entry->display_name }}</a>
    <div class="navbar-dropdown">
    @foreach ($entry->subentries as $subentry)
     <a class="navbar-item" href="{{ $subentry->link }}">{{ $subentry->display_name }}</a>
    @endforeach
   </div>
  </div>
  @endforeach
  </nav>
  @endif
  
  <!--  Breadcrumbs -->
  @if(null !== $breadcrumbs)
  <nav class="breadcrumb" aria-label="breadcrumbs" id="breadcrumbs">
   <ul>
   @foreach ($breadcrumbs as $crumb)
    <li><a href="{{$crumb->link}}">{{$crumb->name}}</a></li>
   @endforeach
  </ul>
 </nav>
 @endif
 <!-- content -->
  <div class="content">
  @yield('caption')
  @yield('content')
  </div>
 </div> 
</div>
@endsection
