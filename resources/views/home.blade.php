@extends('layouts.app')

@section('content')

@if ( !empty($user->bookings[0]) )
    @foreach ($user->bookings as $booking)
        {{ $booking->place->available }}
        <br>
    @endforeach
@else
    No places are assigned to you.
@endif
@endsection
