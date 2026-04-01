@extends('layouts.app')

@section('title', 'Create Project')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
        <li class="breadcrumb-item active">Add New</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <h4 class="m-0 text-primary"><i class="bi bi-plus-circle"></i> Add Project Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <label for="project_name">Project Name <span class="text-danger">*</span></label>
                                    <input type="text" name="project_name" class="form-control" placeholder="e.g. Bounce Emporium" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="department_id">Department <span class="text-danger">*</span></label>
                                    <select name="department_id" class="form-control" required>
                                        <option value="" selected disabled>Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4 form-group">
                                    <label for="sap_customer_code">SAP Customer Code</label>
                                    <input type="text" name="sap_customer_code" class="form-control" placeholder="C000XX">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="customer_type">Customer Type</label>
                                    <input type="text" name="customer_type" class="form-control" placeholder="Food Booth / Internal">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="unit_of_measure">Unit of Measure (UOM)</label>
                                    <input type="text" name="unit_of_measure" class="form-control" placeholder="pcs / liters / sets">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <label for="location_gps">Location (GPS Coordinates)</label>
                                    <input type="text" name="location_gps" class="form-control" placeholder="31.5204, 74.3587">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="warehouse_id">Warehouse ID</label>
                                    <input type="number" name="warehouse_id" class="form-control" placeholder="e.g. 40">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <label for="customer_email">Contact Email</label>
                                    <input type="email" name="customer_email" class="form-control" placeholder="email@example.com">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="customer_phone">Contact Phone</label>
                                    <input type="text" name="customer_phone" class="form-control" placeholder="+92 ...">
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary shadow">
                                    Save Project <i class="bi bi-check"></i>
                                </button>
                                <a href="{{ route('projects.index') }}" class="btn btn-secondary shadow-sm">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection