@extends('layouts.contentNavbarLayout')

@section('title', 'Add Task')

@section('content')
    <h4 class="py-3 mb-4">Edit Task for Project: {{ $project->name }}</h4>
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('project_list.tasksedit.submit', $projecttask->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Task Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $projecttask->name }}"
                        required>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="employee">Employee</label>
                        <select name="employee[]" id="employee"
                            class="form-control @error('employee') is-invalid @enderror" multiple required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                        @error('employee')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="status">Update Status:</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1" @if ($projecttask->status == 1) selected @endif>Done</option>
                        <option value="2" @if ($projecttask->status == 2) selected @endif>Pending</option>
                        <option value="3" @if ($projecttask->status == 3) selected @endif>Bug</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save Task</button>
            </form>

        </div>
    </div>


@endsection
