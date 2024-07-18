@extends('layouts/contentNavbarLayout')

@section('title', 'Users List')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Users</h4>
    <!-- Data Tables -->
    <div class="col-12">
        <div class="card">
            @if(session('success'))
            <div class="alert alert-success m-1">
                {{ session('success') }}
            </div>
            @endif
            <div class="table-responsive">
                <a href="{{ route('users-create') }}" class="btn btn-primary m-3 add-project" style="float: right;"><i class="fa-solid fa-user-plus fa-lg"></i></a>
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th class="text-truncate">User</th>
                            <th class="text-truncate">Email</th>
                            <th class="text-truncate">Currency</th>
                            <th class="text-truncate">Created</th>
                            <th class="text-truncate">Status</th>
                            <th class="text-truncate">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userDataCollection as $userData)
                        @if($userData->type =='user')
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3">
                                            @if ($userData->profile_image)
                                            <img src="{{ asset('storage/' . $userData->profile_image) }}" alt="Avatar" class="rounded-circle">
                                            @else
                                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-truncate">{{ $userData->first_name }}
                                                {{ $userData->last_name }}</h6>
                                            <small class="text-truncate">{{ '#' . $userData->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-truncate">{{ $userData->email }}</td>
                                <td class="text-truncate">{{ $userData->currency }}</td>
                                <td class="text-truncate">{{ $userData->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @if ($userData->active == 1)
                                        <span class="badge bg-label-success rounded-pill">Active</span>
                                    @else
                                        <span class="badge bg-label-secondary rounded-pill">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('users.users-update', ['id' => $userData->id]) }}"><i class="fas fa-edit fa-lg"></i> </a>
                                    <form id="delete-form-{{ $userData->id }}" action="{{ route('users.delete', ['id' => $userData->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="#" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $userData->id }}').submit(); }">
                                        <i class="fas fa-trash fa-lg"></i>
                                     </a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Data Tables -->
@endsection
