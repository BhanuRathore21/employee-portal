@extends('layouts.contentNavbarLayout')

@section('title', 'Add Time Log')

@section('content')
<h4 class="py-3 mb-4">Add Time Log for Task: {{ $task->name }}</h4>

<div class="card">
    <div class="card-body">
        <form action="{{ route('tasks.storetimelog', [$task->project_id, $task->id]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="hours" class="form-label">Hours</label>
                <input type="number" class="form-control" id="hours" name="hours" required>
            </div>
            <div class="mb-3">
                <label for="minutes" class="form-label">Minutes</label>
                <input type="number" class="form-control" id="minutes" name="minutes" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Time Log</button>
        </form>
    </div>
</div>

@endsection
