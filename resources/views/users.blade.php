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
                    @foreach ($users as $user)
                        <div style="padding: 25px;">
                            <p>First Name : {{ $user->firstName }}</p>
                            <p>Last Name : {{ $user->lastName }}</p>
                            Email : {{ $user->email }}
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
