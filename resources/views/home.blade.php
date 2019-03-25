@extends('layouts.app')

@section('content')
    {{$user->booking()}}
    {{$user->booking()->remainingDays()}}
    {{empty($user->place()) ? 'No id' : $user->place()->id}}
    <a href="">
        <button type="button" class="btn btn-outline-success">
            Place request
        </button>
    </a>

    <a href="">
        <button type="button" class="btn btn-outline-danger">
            Cancel the request
        </button>
    </a>
@endsection
