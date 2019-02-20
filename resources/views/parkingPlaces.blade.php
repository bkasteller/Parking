@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-8">
            <div class="card">
                @foreach ($parkingPlaces as $parkingPlace)
                    <div style="padding: 25px;">
                        <p>Parking place number : {{ $parkingPlace->id }}</p>
                        Status : {{ $parkingPlace->status }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
