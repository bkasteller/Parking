@extends('layouts.app')

@section('content')
<div class="row justify-content-center" style="margin-top: 30px;">
    <div class="col-md-8">
        <div class="card">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
              </thead>
                @foreach ($users as $user)
                <tbody>
                    <tr>
                        <td>N°{{ $user->rank }}</td>
                        <td>{{ $user->last_name.' '.$user->first_name }}</td>
                        <td>
                            <form method="POST" action="{{ route('waitingList.update', $user) }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="rank" class="col-md-4 col-form-label text-md-right">{{ __('New Rank : ') }}</label>

                                    <div class="col-md-6">
                                        <input type="text" name="rank" maxlength="3">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Apply') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('waitingList.delete', $user) }}" style="width:0">
                                <button type="button" class="btn btn-outline-danger">
                                    Delete
                                </button>
                            </a>
                        </td>
                    </tr>
                  </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
