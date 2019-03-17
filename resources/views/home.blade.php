@extends('layouts.app')

@section('content')
    <button type="button" class="btn btn-outline-success" onclick="event.preventDefault(); document.getElementById('request').submit();">
        Place request
    </button>

    <form id="request" action="{{ route('booking.create') }}" method="POST" style="display:none;" >
        @csrf
        <input type="hidden" name="user" value="{{ $user->id }}">
    </form>

    <button type="button" class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('cancel').submit();">
        Cancel the request
    </button>

    <form id="cancel" action="{{ route('booking.cancel') }}" method="POST" style="display:none;" >
        @csrf
        <input type="hidden" name="user" value="{{ $user->id }}">
    </form>

@endsection
