@extends('layouts.contentNavbarLayout')

@section('title', 'Add Task')

@section('content')
    <h4 class="py-3 mb-4">Task for Project: {{ $project->name }}</h4>

    <div class="card">
        <div class="table-responsive text-nowrap m-1">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if(session('usertype') === 'admin')
            <a href="{{ route('project_list.taskscreate', ['id' => $project->id]) }}" class="btn btn-primary m-3 add-project" style="float: right;">
                <i class="fa-solid fa-folder-plus fa-lg"></i>
            </a>
            @endif
            <table class="table">
                <thead class="table-light">
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Total Time</th>
                      <th>Created</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    @if(session('user_id') == $task->user_id || session('usertype') == 'admin')
                        <tr>
                            <td><strong>{{ $task->id }}</strong></td>
                            <td><i class="mdi mdi-wallet-travel mdi-20px text-danger me-3"></i><span class="fw-medium"><strong>{{ $task->name }}</strong></span></td>
                            <td><strong>{{ $task->total_time }}</strong></td>
                            <td><strong>{{ $task->created_at }}</strong></td>
                            <td>
                                <a href="#">Edit</a> | <a href="#">Delete</a>
                            </td>
                        </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
