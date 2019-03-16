@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-8">
            <div class="card">
                <table>
                    @foreach ($places as $place)
                        <p>
                            Place N° {{ $place->id }}
                            <br>
                            Assigned to :
                            <br>
                            Last user :
                            <br>

                            <a href="{{ route('place.edit', $place) }}">
                                <button type="button" class="btn btn-outline-success">
                                    Edit
                                </button>
                            </a>

                            <a href="{{ route('place.available', $place) }}">
                                <button type="button" class="btn btn-outline-danger">
                                    @if ( $place->available )
                                        Close
                                    @else
                                        Open
                                    @endif
                                </button>
                            </a>
                        </p>
                    @endforeach
                    <a href="{{ route('place.create') }}">
                        + Add one place
                    </a>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
