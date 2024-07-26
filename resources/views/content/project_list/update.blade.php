<!-- resources/views/projects/create.blade.php -->
@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Project')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="m-3">Manage Project</h3>
                <div class="card-body">
                    <form method="POST" action="{{ route('project_list.update.submit', $project->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Project Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $project->name }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="employee">Employee</label>
                            <select name="employee[]" id="employee" class="form-control @error('employee') is-invalid @enderror" multiple required>
                                @foreach($users as $user)
                                    @if($user->type == 'user')
                                    <option value="{{ $user->id }}" {{ $user->id == $project->employee ? 'selected' : '' }}>
                                        {{ $user->username }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>                                                  
                            @error('employee')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="client">Client</label>
                            <input id="client" type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ $project->client }}" required autocomplete="client">
                            @error('client')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="2" {{ $project->active == 2 ? 'selected' : '' }}>Pending</option>
                                <option value="3" {{ $project->active == 3 ? 'selected' : '' }}>In Progress</option>
                                <option value="1" {{ $project->active == 1 ? 'selected' : '' }}>Done</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-3" style="float: right;">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
