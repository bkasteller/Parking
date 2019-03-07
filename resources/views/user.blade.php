@extends('layouts.app')

@section('content')
@if ( $user->places )
    @foreach ($user->places as $place)
        {{ $place->pivot->date }}
        <?php
            $test = expired($place);
         ?>
         {{ $test['end'] }}
    @endforeach
@endif
@endsection
