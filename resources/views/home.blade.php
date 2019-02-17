@extends('layouts.app')

@section('content')

    @if ( empty($myPlace) )
        <p><B>No places are actually assigned to you</B></p>

        <a href=""
           onclick="event.preventDefault();
                         document.getElementById('request').submit();">
            {{ __('Place Request') }}
        </a>

        <form id="request" method="POST">
            @csrf
        </form>
    @else
        <p>Your place number is <B>{{ $myPlace['attribute']->id }}</B></p>

        <p>Reservation start at <B>{{ $myPlace['start'] }}</B> during for <B>{{ $myPlace['duration'] }}</B> days</p>

        <p>Current date is <B>{{ $myPlace['now'] }}</B></p>

        <p>Reservation end at <B>{{ $myPlace['end'] }}</B></p>

        <p>She expires in <B>{{ $myPlace['days'] }} days</B></p>
    @endif

    <p>Latest places attributed :</p>

    @if ( empty($myPlace['oldPlaces']) )
      <p><B>empty</B></p>
    @else
        @foreach ($myPlace['oldPlaces'] as $place)
            <p>
                @if ( $place->created_at == $myPlace['attribute']->created_at && $myPlace['end'] > $myPlace['now'])
                    {{ $place->id }} -> now
                @else
                    <a href="historic?assign={{ $place->assign_id }}">{{ $place->id }}</a>
                @endif
            </p>
        @endforeach
    @endif

@endsection
