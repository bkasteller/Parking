@extends('layouts.app')

@section('content')
    @if ( !empty($myPlaces[0]) )
        @if ( $myPlace['days'] > 0 || !empty($byRequest) )
            <p>Place number : <B>{{ $myPlace['attributes']->id }}</B></p>

            <p>Reservation start : <B>{{ $myPlace['start'] }}</B> during for <B>{{ $myPlace['duration'] }}</B> days</p>

            <p>Current date : <B>{{ $myPlace['now'] }}</B></p>

            <p>Reservation end : <B>{{ $myPlace['end'] }}</B></p>

            @if ( $myPlace['days'] < 0)
                <p><B>She is expired</B></p>
            @else
                <p>She expires in <B>{{ $myPlace['days'] }} days</B></p>
            @endif
        @else
            <p><B>No places are actually assigned to you</B></p>

            <a href="{{ route('placeRequest') }}">Place Request</a><br>
        @endif
    @else
        <a href="{{ route('placeRequest') }}">Place Request</a><br>
    @endif

    <br>HISTORIC :<br>

    @if ( empty($myPlaces[0]) )
      <B>empty</B>
    @else
        @foreach ($myPlaces as $place)
                @if ( $place->assign_id == $myPlace['attributes']->assign_id )
                    <B>{{ 'place number '.$place->id.' attributed the '.$place->created_at }}</B>
                @else
                    <a href="home?assign={{ $place->assign_id }}">{{ 'place number '.$place->id.' attributed the '.$place->created_at }}</a>
                @endif
            <br>
        @endforeach
    @endif
@endsection
