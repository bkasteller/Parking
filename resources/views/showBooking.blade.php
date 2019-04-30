@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-4">
            <div class="card">
                <div class="card-header">{{ __('History details') }}</div>

                <div class="card-body">
                    Booking id : <B>{{ $booking->id }}</B>
                    <br>
                    User : <B>{{ $booking->user->name() }}</B>
                    <br>
                    Place : <B>N°{{ $booking->place->wording }}</B>
                    <br>
                    Start : <B>{{ showDate($booking->created_at) }}</B>
                    <br>
                    End : <B>{{ showDate($booking->lastDay()) }}</B>
                    <br>
                    Duration : <B>{{ $booking->duration + 1 }} day(s)</B>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
