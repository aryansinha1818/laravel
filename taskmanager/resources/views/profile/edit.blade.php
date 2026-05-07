@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">Profile</div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">New Password</label>
                        <input class="form-control" id="password" name="password" type="password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password_confirmation">Confirm New Password</label>
                        <input class="form-control" id="password_confirmation" name="password_confirmation" type="password">
                    </div>

                    <button class="btn btn-primary" type="submit">Save Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
