@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Place N°').$place->id }}</div>

                <div class="card-body">
                    @if ( $place->occupied() )
                        Assigned to : <B>{{ $place->user()->name() }}</B>
                        <br>
                        Started at : <B>{{ showDate($place->booking()->created_at) }}</B>
                        <br>
                        Assigned for : <B>{{ $place->booking()->duration }} day(s)</B>
                        <br>
                        Ended at : <B>{{ showDate($place->booking()->lastDay()) }}</B>
                        <br>
                        Days remaining : <B>{{ $place->booking()->remainingDays() }}</B>
                        <br>
                        <a href="{{ route('booking.delete', $place->booking()) }}" style="width:0">
                            <button type="button" class="btn btn-outline-danger">
                                End this Booking
                            </button>
                        </a>
                    @else
                        <B>No user assigned to this place</B>
                        <br>
                        Last user : {{ exist($place->booking()) ? $place->booking()->user->name() : "this place is clean" }}
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8 py-4">
            <div class="card">
                <div class="card-header">{{ __('History') }}</div>

                <div class="card-body">
                    @foreach ( $place->bookings as $booking )
                        @if ( $booking->isExpired() )
                            <a href="{{ route('booking.show', $booking) }}">
                                Assigned to <B>{{ $booking->user->name() }}</B> from the <B>{{ showDate($booking->created_at) }}</B> to <B>{{ showDate($booking->lastDay()) }}</B>
                            </a>
                            <br>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
