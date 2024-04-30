<!-- resources/views/projects/create.blade.php -->
@extends('layouts/contentNavbarLayout')

@section('title', 'Project Add')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Project</div>

                <div class="card-body">
                    <form method="POST" action="">
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
                            <input id="employee" type="text" class="form-control @error('employee') is-invalid @enderror" name="employee" value="{{ old('employee') }}" required autocomplete="employee">
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

                        <button type="submit" class="btn btn-primary">Add Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
