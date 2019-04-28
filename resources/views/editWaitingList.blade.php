@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Option</th>
                </tr>
            </thead>

            <tbody>
                @if ( $users->count() == 0 )
                    <tr>
                        <td colspan="3"><B>No users in the waiting list.</B></td>
                    </tr>
                @endif

                <form method="POST" action="{{ route('waitingList.update') }}">
                    @foreach ($users as $user)
                        @csrf

                        <input type="hidden" name="{{ $user->id }}" value="{{ $user->rank }}">

                        <tr>
                            <td>{{ $user->rank }}</td>
                            <td>{{ $user->name() }}</td>
                            <td>
                                <a href="{{ route('waitingList.delete', $user) }}" style="width:0">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Modify') }}
                        </button>
                    </div>
                <form>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $('tbody').sortable();
</script>
@endsection
