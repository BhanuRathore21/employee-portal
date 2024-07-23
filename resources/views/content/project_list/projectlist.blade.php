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
    @if(session('usertype') === 'admin')
    <a href="{{ route('project_list.create') }}" class="btn btn-primary m-3 add-project" style="float: right;"><i class="fa-solid fa-folder-plus fa-lg"></i></a>
    @endif
    <table class="table">
      <thead class="table-light">
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
          @if(session('usertype') === 'admin')
            <a href="{{ route('project_list.update', ['id' => $project->id]) }}"><i class="fas fa-edit fa-lg"></i></a>
            <form id="delete-form-{{ $project->id }}" action="{{ route('project_list.delete', ['id' => $project->id]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            <a href="#" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $project->id }}').submit(); }">
                <i class="fas fa-trash fa-lg"></i>
             </a>
             <a href="{{ route('project_list.tasklist', ['id' => $project->id]) }}"><i class="fas fa-eye fa-lg"></i></a>
          @elseif(session('usertype') === 'user')
             <a href="{{ route('project_list.timelog', ['id' => $project->id,'employee_id'=>session('usertype')]) }}"><i class="fas fa-edit fa-lg"></i></a>
          @else
            <p>No Project Found</p>
          @endif   
      </td>
    </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Basic Bootstrap Table -->

@endsection
