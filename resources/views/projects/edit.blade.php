@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Edit Project: {{ $project->project_name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <label>Project Name <span class="text-danger">*</span></label>
                                <input type="text" name="project_name" class="form-control" value="{{ $project->project_name }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Department <span class="text-danger">*</span></label>
                                <select name="department_id" class="form-control" required>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->id }}" {{ $project->department_id == $dept->id ? 'selected' : '' }}>
                                            {{ $dept->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <label>SAP Customer Code</label>
                                <input type="text" name="sap_customer_code" class="form-control" value="{{ $project->sap_customer_code }}">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Customer Type</label>
                                <input type="text" name="customer_type" class="form-control" value="{{ $project->customer_type }}">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Unit of Measure</label>
                                <input type="text" name="unit_of_measure" class="form-control" value="{{ $project->unit_of_measure }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <label>Customer Email</label>
                                <input type="email" name="customer_email" class="form-control" value="{{ $project->customer_email }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Customer Phone</label>
                                <input type="text" name="customer_phone" class="form-control" value="{{ $project->customer_phone }}">
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update Project</button>
                            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection