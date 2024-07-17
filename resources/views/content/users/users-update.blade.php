<!-- resources/views/User/user-create.blade.php -->
@extends('layouts/contentNavbarLayout')
@section('title', 'User Create')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body pt-2 mt-1">
                <div class="row mt-2 gy-4">
                    <h3 class="m-3">Add New User</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.users-update.submit') }}"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$user->id}}" name="id" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="avatar" class="account-file-input" hidden
                                        accept="image/png, image/jpeg" />
                                </label>
                                <div class="text-muted small">Allowed JPG, GIF or PNG. Max size of 800K</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Username</label>
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{$user->username}}" required autocomplete="username" autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">First Name</label>
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{$user->first_name}}" required autocomplete="first name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="client">Last Name</label>
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{$user->last_name}}" required autocomplete="last_name">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="client">Email</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{$user->email}}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="client">Phone Number</label>
                                <input id="phone_number" type="number"
                                    class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                    value="{{$user->phone_number}}" autocomplete="phone_number">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="client">Organization</label>
                                <input id="organization" type="text"
                                    class="form-control @error('organization') is-invalid @enderror" name="organization"
                                    value="{{$user->organization}}" autocomplete="organization">
                                @error('organization')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" name="address" placeholder="Address" value="{{$user->address}}" required />
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="state">State</label>
                                <input class="form-control @error('state') is-invalid @enderror" type="text"
                                    id="state" name="state" placeholder="California" value="{{$user->state}}"
                                    required />
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="zip_code">Zip Code</label>
                                <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                    id="zip_code" name="zip_code" placeholder="231465" maxlength="6"
                                    value="{{$user->zip_code}}" required />
                                @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="country">Country</label>
                                <select id="country" class="form-select" name="country">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $key => $country)
                                        <option value="{{ $key }}" {{ $user->country == $key ? 'selected' : '' }}>{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="language">Language</label>
                                <select id="language" class="form-select" name="language">
                                    <option value="">Select Language</option>
                                    @foreach ($languages as $key => $language)
                                        <option value="{{ $key }}" {{ $user->language == $key ? 'selected' : '' }}>{{ $language }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="time_zones">Timezone</label>
                                <select id="time_zones" class="form-select" name="time_zones">
                                    <option value="">Select Timezone</option>
                                    @foreach ($timeZones as $key => $timeZone)
                                        <option value="{{ $key }}" {{ $user->time_zones == $key ? 'selected' : '' }}>{{ $timeZone }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="currency">Currency</label>
                                <select id="currency" class="form-select" name="currency">
                                    <option value="">Select Currency</option>
                                    @foreach ($currencies as $key => $currency)
                                        <option value="{{ $key }}" {{ $user->currency == $key ? 'selected' : '' }}>{{ $currency }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" style="float: right;">Add User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
