@extends('layouts.app')

@section('title', 'Edit Department')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('departments.index') }}">Departments</a></li>
                    <li class="breadcrumb-item active">Edit Department</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h4 class="m-0">
                        <i class="bi bi-pencil-square mr-2"></i> Edit: {{ $department->name }}
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('departments.update', $department->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Department Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           name="name" id="name" value="{{ old('name', $department->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code" class="font-weight-bold">Department Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                           name="code" id="code" value="{{ old('code', $department->code) }}" required>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dep_type" class="font-weight-bold">Department Type <span class="text-danger">*</span></label>
                                    <select class="form-control @error('dep_type') is-invalid @enderror" name="dep_type" id="dep_type" required>
                                        <option value="Core" {{ (old('dep_type', $department->dep_type) == 'Core') ? 'selected' : '' }}>Core Operational</option>
                                        <option value="Business" {{ (old('dep_type', $department->dep_type) == 'Business') ? 'selected' : '' }}>Business & Support</option>
                                        <option value="Tech" {{ (old('dep_type', $department->dep_type) == 'Tech') ? 'selected' : '' }}>Technical & Internal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="manager_id" class="font-weight-bold">Manager</label>
                                    <select class="form-control" name="manager_id" id="manager_id">
                                        <option value="">Select Manager</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ (old('manager_id', $department->manager_id) == $user->id) ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status" class="font-weight-bold">Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="1" {{ (old('status', $department->status) == 1) ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ (old('status', $department->status) == 0) ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3">{{ old('description', $department->description) }}</textarea>
                        </div>

                        <hr>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-warning px-4 shadow-sm text-dark font-weight-bold">
                                <i class="bi bi-arrow-repeat mr-1"></i> Update Department
                            </button>
                            <a href="{{ route('departments.index') }}" class="btn btn-secondary px-4">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection