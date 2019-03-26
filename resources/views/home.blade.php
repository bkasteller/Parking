@extends('layouts.app')

@section('content')
    {{$user->booking()}}
    {{exist($user->booking()) ? $user->booking()->remainingDays() : NULL}}
    {{exist($user->place()) ? $user->place()->id : NULL}}
    <a href="{{ route('booking.create') }}">
        <button type="button" class="btn btn-outline-success">
            Request place
        </button>
    </a>

    <a href="{{ route('booking.cancel') }}">
        <button type="button" class="btn btn-outline-danger">
            Cancel the request
        </button>
    </a>
@endsection
