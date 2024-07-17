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
                            <th class="text-truncate">Role</th>
                            <th class="text-truncate">Currency</th>
                            <th class="text-truncate">Created</th>
                            <th class="text-truncate">Status</th>
                            <th class="text-truncate">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userDataCollection as $userData)
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
                                <td class="text-truncate">
                                    @if ($userData->role == 'admin')
                                        <i class="mdi mdi-laptop mdi-24px text-danger me-1"></i> Admin
                                    @elseif ($userData->role == 'editor')
                                        <i class="mdi mdi-pencil-outline text-info mdi-24px me-1"></i> Editor
                                    @elseif ($userData->role == 'author')
                                        <i class="mdi mdi-cog-outline text-warning mdi-24px me-1"></i> Author
                                    @elseif ($userData->role == 'maintainer')
                                        <i class="mdi mdi-chart-donut mdi-24px text-success me-1"></i> Maintainer
                                    @else
                                        <i class="mdi mdi-account-outline mdi-24px text-primary me-1"></i> Subscriber
                                    @endif
                                </td>
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
                                    <a href="{{ route('users-create') }}"><i class="fas fa-trash fa-lg"></i>  </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Data Tables -->
@endsection
