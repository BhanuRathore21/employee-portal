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
                    <input type="text" class="form-control" id="name" name="name" value="{{ $projecttask->name }}" required>
                </div>
    
                <div class="mb-3">
                    <label for="hours">Add Time:</label>
                    <div class="input-group">
                        <input type="number" name="hours" id="hours" class="form-control" placeholder="Hours" value="" required>
                        <div class="input-group-append">
                            <span class="input-group-text">hours</span>
                        </div>
                    </div>
                </div>
    
                <div class="mb-3">
                    <div class="input-group">
                        <input type="number" name="minutes" id="minutes" class="form-control" placeholder="Minutes" value="" required>
                        <div class="input-group-append">
                            <span class="input-group-text">mins</span>
                        </div>
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