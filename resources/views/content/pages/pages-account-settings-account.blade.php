@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Account Settings /</span> Account
    </h4>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-4 gap-2 gap-lg-0">
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                            class="mdi mdi-account-outline mdi-20px me-1"></i>Account</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('pages/account-settings-notifications') }}"><i
                            class="mdi mdi-bell-outline mdi-20px me-1"></i>Notifications</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('pages/account-settings-connections') }}"><i
                            class="mdi mdi-link mdi-20px me-1"></i>Connections</a></li>
            </ul>
            <div class="card mb-4">
                <h4 class="card-header">Profile Details</h4>
                <!-- Account -->
                <form action="{{ route('pages.account.settings.account.submit') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Avatar upload -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @if ($userData->profile_image)
                                <img src="{{ asset('storage/' . $userData->profile_image) }}" alt="user-avatar"
                                    class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar" />
                            @else
                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Default Profile Image"
                                    class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar">
                            @endif
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="avatar" class="account-file-input" hidden
                                        accept="image/png, image/jpeg" />
                                </label>
                                <div class="text-muted small">Allowed JPG, GIF or PNG. Max size of 800K</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2 mt-1">
                        <div class="row mt-2 gy-4">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="text" id="firstName" name="firstName"
                                        value="{{ old('firstName', $userData->first_name) }}" required />
                                    <label for="firstName">First Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="text" name="lastName" id="lastName"
                                        value="{{ old('last_name', $userData->last_name) }}" required />
                                    <label for="lastName">Last Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ old('email', $userData->email) }}" placeholder="john.doe@example.com"
                                        required />
                                    <label for="email">E-mail</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="organization" name="organization"
                                        value="{{ old('organization', $userData->organization) }}" required />
                                    <label for="organization">Organization</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                            placeholder="202 555 0111"
                                            value="{{ old('phone_number', $userData->phone_number) }}" required />
                                        <label for="phoneNumber">Phone Number</label>
                                    </div>
                                    <span class="input-group-text">US (+1)</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Address" value="{{ old('address', $userData->address) }}" required />
                                    <label for="address">Address</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="text" id="state" name="state"
                                        placeholder="California" value="{{ old('state', $userData->state) }}" required />
                                    <label for="state">State</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="zipCode" name="zipCode"
                                        placeholder="231465" maxlength="6"
                                        value="{{ old('zip_code', $userData->zip_code) }}" required />
                                    <label for="zipCode">Zip Code</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select id="country" class="select2 form-select" name="country">
                                        <option value="">Select</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country }}"
                                                {{ $userData->country === $country ? 'selected' : '' }}>
                                                {{ $country }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="country">Country</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select id="language" class="select2 form-select" name="language">
                                        <option value="">Select Language</option>
                                        @foreach ($languages as $key => $language)
                                            <option value="{{ $key }}"
                                                {{ $userData->language === $key ? 'selected' : '' }}>
                                                {{ $language }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="language">Language</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select id="timeZones" class="select2 form-select" name="timeZones">
                                        <option value="">Select Timezone</option>
                                        @foreach ($timeZones as $key => $timeZone)
                                            <option value="{{ $key }}"
                                                {{ $userData->time_zones === $key ? 'selected' : '' }}>
                                                {{ $timeZone }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="timeZones">Timezone</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select id="currency" class="select2 form-select" name="currency">
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $key => $currency)
                                            <option value="{{ $key }}"
                                                {{ $userData->currency === $key ? 'selected' : '' }}>
                                                {{ $currency }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="currency">Currency</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
        <div class="card">
            <h5 class="card-header fw-normal">Delete Account</h5>
            <div class="card-body">
                <div class="mb-3 col-12 mb-0">
                    <div class="alert alert-warning">
                        <h6 class="alert-heading mb-1">Are you sure you want to delete your account?</h6>
                        <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                    </div>
                </div>
                <form action="{{ route('pages.account.settings.account.submit.deactivate') }}" method="POST">
                    <div class="form-check mb-3 ms-3">
                        <input class="form-check-input" type="checkbox" name="accountActivation"
                            id="accountActivation" />
                        <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                    </div>
                    <button type="submit" class="btn btn-danger">Deactivate Account</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
