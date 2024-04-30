<!-- resources/views/projects/create.blade.php -->
@extends('layouts/contentNavbarLayout')

@section('title', 'Project Add')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="m-3">Add New Project</h3>
                <div class="card-body">
                    <form method="POST" action="{{ route('project_list.create.submit') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Project Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
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
                            <input id="client" type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ old('client') }}" required autocomplete="client">
                            @error('client')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Add other fields as needed -->

                        <button type="submit" class="btn btn-primary mt-3" style="float: right;">Add Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
