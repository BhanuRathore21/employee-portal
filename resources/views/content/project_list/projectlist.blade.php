@extends('layouts/contentNavbarLayout')

@section('title', 'Project List')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Project List
</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
  <div class="table-responsive text-nowrap m-1">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{ route('project_list.create') }}" class="btn btn-primary m-3 add-project" style="float: right;">+ Project</a>
    <table class="table">
      <thead>
        <tr>
          <th>Project</th>
          <th>Client</th>
          <th>Users</th>
          <th>Status</th>
          <th>Created</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($projects as $project)
        <tr>
        <td><i class="mdi mdi-wallet-travel mdi-20px text-danger me-3"></i><span class="fw-medium"><strong>{{ $project->name }}</strong></span></td>
        <td><strong>{{ $project->client }}</strong></td>
        <td>
          <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              @if (strpos($project->employee, ',') !== false)
                  @php
                      $employeeNames = explode(',', $project->employee);
                  @endphp
                  @foreach ($employeeNames as $name)
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="{{ $name }}">
                          <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar" class="rounded-circle">
                      </li>
                  @endforeach
              @else
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="{{ $project->employee }}">
                      <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar" class="rounded-circle">
                  </li>
              @endif
          </ul>
      </td>      
        <td><span class="badge rounded-pill bg-label-primary me-1">{{ $project->active == 1 ? 'Active' : 'Inactive' }}</span></td>
        <td><strong>{{ $project->created_at->format('d F Y g:i A') }}</strong></td>
        <td>
        <div class="dropdown">
          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="javascript:void(0);"><i class="mdi mdi-pencil-outline me-1"></i> Edit</a>
            <a class="dropdown-item" href="javascript:void(0);"><i class="mdi mdi-trash-can-outline me-1"></i> Delete</a>
          </div>
        </div>
      </td>
    </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Basic Bootstrap Table -->

@endsection
