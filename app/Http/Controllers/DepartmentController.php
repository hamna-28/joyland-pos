<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the departments.
     */
    public function index()
    {
        // We use 'with' to eager load the manager relationship to prevent slow queries
        $departments = Department::with('manager')->get();

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new department.
     */
    public function create()
    {
        // Fetch all users so we can assign them as managers in the dropdown
        $users = User::all();

        return view('departments.create', compact('users'));
    }

    /**
     * Store a newly created department in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'code'        => 'required|string|max:20|unique:departments,code',
            'dep_type'    => 'required|string',
            'manager_id'  => 'nullable|exists:users,id',
            'description' => 'nullable|string'
        ]);

        Department::create([
            'name'        => $request->name,
            'code'        => $request->code,
            'dep_type'    => $request->dep_type,
            'manager_id'  => $request->manager_id,
            'description' => $request->description,
            'status'      => 1 // Default to active on creation
        ]);

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully!');
    }

    /**
     * Show the form for editing the specified department.
     */
    public function edit(Department $department)
    {
        $users = User::all();

        return view('departments.edit', compact('department', 'users'));
    }

    /**
     * Update the specified department in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'code'       => 'required|string|max:20|unique:departments,code,' . $department->id,
            'dep_type'   => 'required|string',
            'manager_id' => 'nullable|exists:users,id',
            'status'     => 'required|integer'
        ]);

        $department->update([
            'name'        => $request->name,
            'code'        => $request->code,
            'dep_type'    => $request->dep_type,
            'manager_id'  => $request->manager_id,
            'status'      => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully!');
    }

    /**
     * Remove the specified department from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully!');
    }
}