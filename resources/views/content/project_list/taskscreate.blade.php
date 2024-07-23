@extends('layouts.contentNavbarLayout')

@section('title', 'Add Task')

@section('content')
<h4 class="py-3 mb-4">Add Task for Project: {{ $project->name }}</h4>
<div class="card">
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('project_list.taskscreate.submit', $project->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Task Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
    </div>
</div>

@endsection
