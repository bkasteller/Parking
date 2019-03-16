@extends('layouts.app')

@section('content')
    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-8">
            <div class="card">
                @if ( occupied($place) )
                    {{ $booking->id }}
                    {{ $user->firstName }}
                @else
                    No user is assigned to this place.
                    <br>
                    @if ( place_user($place) )
                        The last user is : {{ place_user($place)->lastName.' '.place_user($place)->firstName }}
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
