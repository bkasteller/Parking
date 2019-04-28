@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Place') }}</div>

                <div class="card-body">
                    @if ( exist($user->place()) )
                        You have the place <B>N°{{ $user->booking()->place_id }}</B>
                        <br>
                        Start : <B>{{ showDate($user->booking()->created_at) }}</B>
                        <br>
                        Assigned for : <B>{{ $user->booking()->duration }} day(s)</B>
                        <br>
                        End : <B>{{ showDate($user->booking()->lastDay()) }}</B>
                        <br>
                        Days remaining : <B>{{ $user->booking()->remainingDays() }}</B>
                    @else
                        <B>You have no place at the moment</B>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8 py-4">
            <div class="card">
                <div class="card-body">
                    @if ( empty($user->place()) )
                        <a href="{{ route('booking.create') }}">
                            <button type="button" class="btn btn-outline-success">
                                Request place
                            </button>
                        </a>
                    @else
                        <a href="{{ route('booking.cancel') }}">
                            <button type="button" class="btn btn-outline-danger">
                                @if ( empty($user->place()) )
                                    Cancel the request
                                @else
                                    Leave this place
                                @endif
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8 py-4">
            <div class="card">
                <div class="card-header">{{ __('History') }}</div>

                <div class="card-body">
                    @foreach ( $user->bookings as $booking )
                        <a href="{{ route('history', $booking) }}">
                            Booking from the <B>{{ showDate($booking->created_at) }}</B> to <B>{{ showDate($booking->lastDay()) }}</B>
                        </a>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
