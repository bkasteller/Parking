@extends('layouts.app')

@section('content')
    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-8">
            <div class="card-header">{{ __('Place N°').$place->id }}</div>

            <div class="card">
                @if ( $place->occupied() )
                    Actually assigned to {{ $place->user()->name() }} for {{ $place->booking()->remainingDays() }} days remaining.
                    <br>
                    <a href="{{ route('booking.delete', $place->booking()) }}" style="width:0">
                        <button type="button" class="btn btn-outline-danger">
                            End this Booking
                        </button>
                    </a>
                @else
                    No user is assigned to this place.
                    <br>
                    @if ( exist($place->booking()) )
                        The last user is : {{ $place->booking()->user->name() }}
                    @endif
                @endif
            </div>
        </div>
    </div>

    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-8">
            <div class="card-header">{{ __('History') }}</div>

            <div class="card">
                @foreach( $bookings as $booking )
                    ------------------ From {{ $booking->created_at->format('Y-m-d') }} to {{ $booking->lastDay()->format('Y-m-d') }} ------------------
                    <br>
                    Assigned to {{ $booking->user->name()  }} for {{ $booking->duration+1 }} day(s) (Booking N°{{ $booking->id }})
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection
