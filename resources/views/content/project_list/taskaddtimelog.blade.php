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

            <form action="{{ route('project_list.taskaddtimelog.submit', $projecttask->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="hours">Add Time:</label>
                    <div class="input-group">
                        <input type="number" name="hours" id="hours" class="form-control" placeholder="Hours"
                            value="" required>
                        <div class="input-group-append">
                            <span class="input-group-text">Hours</span>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <input type="number" name="minutes" id="minutes" class="form-control" placeholder="Minutes"
                            value="" required>
                        <div class="input-group-append">
                            <span class="input-group-text">Mins</span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add TimeLog</button>
            </form>

        </div>
    </div>


@endsection
