@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Status') }}</div>

                <div class="card-body">
                    @if ( empty($user->place()) )
                        @if ( $user->isRanked() )
                            <B>You are actually in the queue, your position is {{ $user->rank }}</B>
                            <br>
                            <a href="{{ route('booking.cancel') }}">
                                <button type="button" class="btn btn-outline-danger">
                                    Cancel the request
                                </button>
                            </a>
                        @else
                            <B>You have no place</B>
                            <br>
                            <a href="{{ route('booking.create') }}">
                                <button type="button" class="btn btn-outline-success">
                                    Request place
                                </button>
                            </a>
                        @endif
                    @else
                        You get the place <B>N°{{ $user->booking()->getPlaceWording() }}</B>
                        <br>
                        Started at : <B>{{ showDate($user->booking()->created_at) }}</B>
                        <br>
                        Assigned for : <B>{{ $user->booking()->duration }} day(s)</B>
                        <br>
                        Ended at : <B>{{ showDate($user->booking()->lastDay()) }}</B>
                        <br>
                        Days remaining : <B>{{ $user->booking()->remainingDays() }}</B>
                        <br>
                        <a href="{{ route('booking.cancel') }}">
                            <button type="button" class="btn btn-outline-danger">
                                Leave this place
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
                        @if ( $booking->isExpired() )
                            <a href="{{ route('booking.show', $booking) }}">
                                <B>Place N°{{ $booking->place->wording }}</B> from the <B>{{ showDate($booking->created_at) }}</B> to <B>{{ showDate($booking->lastDay()) }}</B>
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
