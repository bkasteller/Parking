@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Search an USER') }}</div>

                <div class="card-body">
                    <form method="POST" action="users">
                        @csrf

                        <div class="form-group row">
                            <label for="lastName" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last-name" type="text" class="form-control" name="lastName">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstName" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first-name" type="texte" class="form-control" name="firstName">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="texte" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</div>

                            <div class="col-md-6">
                                <label for="member" class="col-md-4 col-form-label text-md-right">{{ __('Member') }}</label>
                                <input type="radio" id="member" name="type" value="member">

                                <label for="admin" class="col-md-4 col-form-label text-md-right">{{ __('Admin') }}</label>
                                <input type="radio" id="admin" name="type" value="admin">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</div>

                            <div class="col-md-6">
                                <label for="deactivate" class="col-md-4 col-form-label text-md-right">{{ __('Deactivate') }}</label>
                                <input type="radio" id="deactivate" name="status" value="0">

                                <label for="hidden" class="col-md-4 col-form-label text-md-right">{{ __('Hidden') }}</label>
                                <input type="radio" id="hidden" name="status" value="0">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-8">
            <div class="card">
                @if ( !empty($users[0]) )
                    @foreach ( $users as $user )
                        <div style="padding: 25px;">
                            First Name : {{ $user->firstName }}
                            <br>
                            Last Name : {{ $user->lastName }}
                            <br>
                            Email : {{ $user->email }}
                            <br>
                            @if ( $user->activate )
                                <button type="button" class="btn btn-outline-success" href="{{ route('deactivateUser')}}" onclick="event.preventDefault(); document.getElementById('deactivate-user').submit();">Deactive</button>
                            @else
                                <button type="button" class="btn btn-outline-primary" href="{{ route('activateUser')}}" onclick="event.preventDefault(); document.getElementById('activate-user').submit();">Active</button>
                            @endif

                            <form id="activate-user" action="{{ route('activateUser') }}" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <input type="hidden" name="user_activate" value="{{ $user->activate }}">
                            </form>

                            <button type="button" class="btn btn-outline-warning" href="{{ route('updateUser')}}" onclick="event.preventDefault(); document.getElementById('update-user').submit();">Update</button>

                            <form id="update-user" action="{{ route('updateUser') }}" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                            </form>

                            <button type="button" class="btn btn-outline-danger" href="{{ route('deleteUser')}}" onclick="event.preventDefault(); document.getElementById('delete-user').submit();">Delete</button>

                            <form id="update-user" action="{{ route('deleteUser') }}" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                            </form>
                        </div>
                    @endforeach
                @else
                    <div style="padding: 30px;">No users found.</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
