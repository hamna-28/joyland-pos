@extends('layouts.app')

@section('title', 'Create Department')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('departments.index') }}">Departments</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="m-0"><i class="bi bi-plus-circle mr-2"></i> Add New Department</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('departments.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Department Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           name="name" id="name" value="{{ old('name') }}" 
                                           placeholder="e.g. Human Resources" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code" class="font-weight-bold">Department Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                           name="code" id="code" value="{{ old('code') }}" 
                                           placeholder="e.g. HR-01" required>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dep_type" class="font-weight-bold">Department Type <span class="text-danger">*</span></label>
                                    <select class="form-control @error('dep_type') is-invalid @enderror" name="dep_type" id="dep_type" required>
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="Core" {{ old('dep_type') == 'Core' ? 'selected' : '' }}>Core Operational</option>
                                        <option value="Business" {{ old('dep_type') == 'Business' ? 'selected' : '' }}>Business & Support</option>
                                        <option value="Tech" {{ old('dep_type') == 'Tech' ? 'selected' : '' }}>Technical & Internal</option>
                                    </select>
                                    @error('dep_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="manager_id" class="font-weight-bold">Assign Manager</label>
                                    <select class="form-control @error('manager_id') is-invalid @enderror" name="manager_id" id="manager_id">
                                        <option value="">Select Manager</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('manager_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('manager_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3" 
                                      placeholder="Briefly describe the department's role...">{{ old('description') }}</textarea>
                        </div>

                        <hr>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="bi bi-save mr-1"></i> Save Department
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