@extends('layouts.app')

@section('content')
    @if ( !empty($place) )
        {{$place->id}}
    @else
        This place doesn't exist.
    @endif
@endsection
