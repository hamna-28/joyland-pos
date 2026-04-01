@extends('layouts.app')

@section('title', 'Departments List')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Departments</li>
                </ol>
            </nav>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill mr-2"></i>
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card border-0 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="m-0"><i class="bi bi-building mr-2 text-primary"></i> Joyland Departments</h4>
                    <a href="{{ route('departments.create') }}" class="btn btn-primary shadow-sm">
                        <i class="bi bi-plus-lg"></i> Add New Department
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0">
                            <thead class="thead-light text-uppercase">
                                <tr>
                                    <th class="align-middle text-center">ID</th>
                                    <th class="align-middle">Code</th>
                                    <th class="align-middle">Department Name</th>
                                    <th class="align-middle">Type</th>
                                    <th class="align-middle">Manager</th>
                                    <th class="align-middle text-center">Status</th>
                                    <th class="align-middle">Created At</th>
                                    <th class="align-middle text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($departments as $dept)
                                <tr>
                                    <td class="align-middle text-center text-muted">{{ $dept->id }}</td>
                                    <td class="align-middle">
                                        <span class="badge badge-info px-2 py-1">{{ $dept->code }}</span>
                                    </td>
                                    <td class="align-middle font-weight-bold">
                                        {{ $dept->name }}
                                    </td>
                                   <td class="align-middle">
    <span style="color: #495057 !important; font-weight: 600; opacity: 1 !important;">
        {{ ucfirst($dept->dep_type) }}
    </span>
</td>
                                    <td class="align-middle">
                                        {{ $dept->manager->name ?? 'Unassigned' }}
                                    </td>
                                    <td class="align-middle text-center">
                                        @if($dept->status)
                                            <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        {{ $dept->created_at->format('d M, Y') }}
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('departments.edit', $dept->id) }}" class="btn btn-info btn-sm text-white" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('departments.destroy', $dept->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete the {{ $dept->name }} department?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-info-circle display-4"></i>
                                            <p class="mt-2">No Departments found. Click "Add New Department" to start.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection