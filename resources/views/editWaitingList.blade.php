@extends('layouts.app')

@section('content')
<div class="row justify-content-center" style="margin-top: 30px;">
    <div class="col-md-8">
        <div class="card">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>RANK</th>
                        <th>NAME</th>
                        <th>UP</th>
                        <th>DOWN</th>
                        <th>DELETE</th>
                    </tr>
                </thead>

                <tbody>
                    @if ( $users->count() == 0 )
                        <td colspan="3"><B>No users in the waiting list.</B></td>
                    @endif

                    @foreach ($users as $user)
                        <tr>
                            <td>N° {{ $user->rank }}</td>
                            <td>{{ $user->name() }}</td>
                            <td>
                                @if ( $user->rank != 1 )
                                    <form method="POST" action="{{ route('waitingList.update') }}">
                                        @csrf
                                        <input type="hidden" name="last_rank" value="{{ $user->rank }}">
                                        <input type="hidden" name="new_rank" value="{{ $user->rank-1 }}">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('up') }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                @if ( $user->rank != lastRank() )
                                    <form method="POST" action="{{ route('waitingList.update') }}">
                                        @csrf
                                        <input type="hidden" name="last_rank" value="{{ $user->rank }}">
                                        <input type="hidden" name="new_rank" value="{{ $user->rank+1 }}">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('down') }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('waitingList.delete', $user) }}" style="width:0">
                                    <button type="button" class="btn btn-outline-danger">
                                        Delete
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-body row justify-content-center">
            <form method="POST" action="{{ route('waitingList.update') }}">
                @csrf
                <input type="text" name="last_rank" placeholder="last rank" maxlength="3">
                <input type="text" name="new_rank" placeholder="new rank" maxlength="3">

                <button type="submit" class="btn btn-primary">
                    {{ __('Change') }}
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
