@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-8">
            <div class="card">
                @foreach ($parkingPlaces as $parkingPlace)
                    <div style="padding: 25px;">
                        <p>Parking place number : {{ $parkingPlace->id }}</p>
                        <p>Status : {{ $parkingPlace->status }}</p>
                        <a href="">Change Status</a> or <a href="">Delete</a>
                    </div>
                @endforeach
                <p style="padding: 25px;"><a href="">+ Add a parking place</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
