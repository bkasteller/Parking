@extends('layouts.app')

@section('content')
    @if ( notEmpty($user->places) )
        @foreach ($user->places as $place)
            <!--{{ $place->pivot->date }}-->
            {{ isExpired($place) }}
            {{ lastDay($place) }}
            {{ remainingDays($place) }}
            {{ dateToFrench($place->pivot->date) }}
            {{ dateToFrench(lastDay($place)) }}
            <br>
        @endforeach
    @else
        No places are assigned to you.
    @endif
@endsection
