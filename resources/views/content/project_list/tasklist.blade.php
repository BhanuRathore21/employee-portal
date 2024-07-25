@extends('layouts.contentNavbarLayout')

@section('title', 'Add Task')

@section('content')
    <h4 class="py-3 mb-4">Task for Project: {{ $project->name }}</h4>

    <div class="card">
        <div class="table-responsive m-1">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('usertype') === 'admin') 
                <a href="{{ route('project_list.taskscreate', ['id' => $project->id]) }}"
                    class="btn btn-primary m-3 add-project" style="float: right;">
                    <i class="fa-solid fa-folder-plus fa-lg"></i>
                </a>
            @endif
             <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Time Log</th>
                        <th class="text-center">Created</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        @if (session('user_id') == $task->user_id || session('usertype') == 'admin')
                            <tr>
                                <td class="text-center"><strong>{{ $task->id }}</strong></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="mdi mdi-progress-clock mdi-24px text-info me-3"></i>
                                        <div>
                                            <span class="fw-medium"><strong>{{ $task->name }}</strong></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center"><strong>{{ $task->total_time }}</strong></td>
                                <td class="text-center"><strong>{{ $task->created_at->format('j F Y h:i a') }}</strong></td>
                                <td class="text-center">
                                    @if ($task->status == 1)
                                        <span class="badge bg-success"><i
                                                class="mdi mdi-checkbox-marked-circle-outline"></i> Done</span>
                                    @elseif($task->status == 2)
                                        <span class="badge bg-warning text-dark"><i class="mdi mdi-clock-alert-outline"></i>
                                            Pending</span>
                                    @elseif($task->status == 3)
                                        <span class="badge bg-danger"><i class="mdi mdi-bug-outline"></i> Bug</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('project_list.tasksedit', ['id' => $task->id]) }}"><i class="fas fa-edit fa-lg"></i></a>
                                    <form id="delete-form-{{ $task->id }}" action="{{ route('project_list.tasksdelete', ['id' => $task->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="#" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $task->id }}').submit(); }">
                                        <i class="fas fa-trash fa-lg"></i>
                                     </a>
                                     <a href="{{ route('project_list.taskaddtimelog', ['id' => $task->id]) }}"><i class="fas fa-plus fa-lg"></i></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
