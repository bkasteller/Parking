@extends('layouts.app')

@section('content')
    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-8">
            <div class="card-header">{{ __('Place N°').$place->id }}</div>

            <div class="card">
                @if ( $place->occupied() )
                    Actually assigned to {{ $place->user()->last_name.' '.$place->user()->first_name  }} for {{ $place->booking()->remainingDays() }} days remaining.
                    <br>
                    <a href="{{ route('booking.delete', $place->booking()) }}" style="width:0">
                        <button type="button" class="btn btn-outline-danger">
                            End this Booking
                        </button>
                    </a>
                @else
                    No user is assigned to this place.
                    <br>
                    @if ( exist($place->user()) )
                        The last user is : {{ $place->user()->last_name.' '.$place->user()->first_name }}
                    @endif
                @endif
            </div>
        </div>
    </div>

    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-8">
            <div class="card-header">{{ __('Historic') }}</div>

            <div class="card">
                @foreach( $place->bookings as $booking )
                    ------------------ From {{ toDate($booking->created_at) }} to {{ $booking->lastDay() }} ------------------
                    <br>
                    Assigned to {{ $booking->user->last_name.' '.$booking->user->first_name  }} for {{ $booking->duration ? $booking->duration : '∞' }} days (Booking N°{{ $booking->id }})
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection
