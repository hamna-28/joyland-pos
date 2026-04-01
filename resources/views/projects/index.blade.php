@extends('layouts.app')

@section('title', 'Projects')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Projects</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h4 class="m-0 text-primary font-weight-bold"><i class="bi bi-kanban"></i> Projects List</h4>
                        <a href="{{ route('projects.create') }}" class="btn btn-primary shadow-sm" style="background-color: #3b2cc0; border-color: #3b2cc0;">
                            <i class="bi bi-plus"></i> Add New Project
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered mb-0">
                                {{-- Updated Header: Darker and Bolder --}}
                                <thead style="background-color: #f1f5f9;">
                                    <tr>
                                        <th class="text-dark font-weight-black" style="font-size: 1rem; border-bottom: 2px solid #cbd5e1;">Project Name</th>
                                        <th class="text-dark font-weight-black text-center" style="font-size: 1rem; border-bottom: 2px solid #cbd5e1;">Department</th>
                                        <th class="text-dark font-weight-black" style="font-size: 1rem; border-bottom: 2px solid #cbd5e1;">SAP Code</th>
                                        <th class="text-dark font-weight-black" style="font-size: 1rem; border-bottom: 2px solid #cbd5e1;">Customer Type</th>
                                        <th class="text-dark font-weight-black" style="font-size: 1rem; border-bottom: 2px solid #cbd5e1;">UOM</th>
                                        <th class="text-dark font-weight-black" style="font-size: 1rem; border-bottom: 2px solid #cbd5e1;">Location of Project</th>
                                        <th class="text-dark font-weight-black text-center" style="font-size: 1rem; border-bottom: 2px solid #cbd5e1;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($projects as $project)
                                        <tr>
                                            <td class="align-middle font-weight-bold text-dark">{{ $project->project_name }}</td>
                                            <td class="align-middle text-center">
                                                {{-- Updated Badge: Professional Indigo/Navy --}}
                                                <span class="badge px-3 py-2 text-white" style="background-color: #4338ca; border-radius: 4px; font-weight: 600; min-width: 100px;">
                                                    {{ $project->department->name ?? 'Unassigned' }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="font-weight-bold" style="color: #be185d;">{{ $project->sap_customer_code ?? 'N/A' }}</span>
                                            </td>
                                            <td class="align-middle text-dark">{{ $project->customer_type ?? '-' }}</td>
                                            <td class="align-middle text-dark">{{ $project->unit_of_measure ?? '-' }}</td>
                                            <td class="align-middle">
                                                <span class="text-dark font-weight-normal" style="font-size: 0.9rem;">
                                                    {{ $project->location_gps ?? 'No Data' }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary btn-sm shadow-sm" style="background-color: #2563eb; border: none;">
                                                    <i class="bi bi-pencil" style="color: white;"></i>
                                                </a>
                                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm shadow-sm" style="background-color: #dc2626; border: none;">
                                                        <i class="bi bi-trash" style="color: white;"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-danger font-weight-bold">No projects found.</td>
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