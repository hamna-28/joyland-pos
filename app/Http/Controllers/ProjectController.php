<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        // We use with('department') to avoid N+1 query issues
        $projects = Project::with('department')->get();
        
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        $departments = Department::all();
        
        return view('projects.create', compact('departments'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name'  => 'required|string|max:255',
            'department_id' => 'required|integer|exists:departments,id',
            'customer_email'=> 'nullable|email',
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        $departments = Department::all();
        
        return view('projects.edit', compact('project', 'departments'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'project_name'  => 'required|string|max:255',
            'department_id' => 'required|integer|exists:departments,id',
            'customer_email'=> 'nullable|email',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}