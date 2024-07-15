<!-- resources/views/User/user-create.blade.php -->
@extends('layouts/contentNavbarLayout')

@section('title', 'User Create')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="m-3">Add New User</h3>
                <div class="card-body">
                    <form method="POST" action="{{ route('users-create.submit') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Username</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input id="first-name" type="text" class="form-control @error('first-name') is-invalid @enderror" name="first-name" value="{{ old('first-name') }}" required autocomplete="first-name" autofocus>
                            @error('first-name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="client">Last Name</label>
                            <input id="last-name" type="text" class="form-control @error('last-name') is-invalid @enderror" name="last-name" value="{{ old('last-name') }}" required autocomplete="last-name">
                            @error('last-name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Add other fields as needed -->

                        <button type="submit" class="btn btn-primary mt-3" style="float: right;">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
