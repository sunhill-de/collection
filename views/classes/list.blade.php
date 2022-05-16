@extends('visual::basic.navigation')

@section('title','Klassen auflisten')

@section('body')
@parent
       <table>
        <caption>Klassen auflisten</caption>
        <tr>
         <th>Name</th>
         <th>Parent</th>
         <th>&nbsp;</th>
         <th>&nbsp;</th>
         <th>&nbsp;</th>
        </tr>
        @forelse($classes as $class)
        <tr>
         <td>{{$class->name}}</td>
         <td>{{$class->parent}}</td>
         <td><a href="/classes/show/{{$class->name}}">anzeigen</a></td>
         <td><a href="/objects/list/{{$class->name}}">Objekte auflisten</a></td>
         <td><a href="/objects/add/{{$class->name}}">Objekt hinzuf&uuml;gen</a></td>
        </tr>
        @empty
        <tr>
         <td colspan="5">Keine Eintr&auml;ge</td>
        </tr> 
        @endforelse
       </table>
       <a href="/">&Uuml;bersicht</a>
@endsection
