<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;

class DepartmentController extends Controller
{
    public function __construct()
    {
        // optional: apply auth to admin resource routes in routes/web.php
    }

    /**
     * Admin: list all departments
     */
    public function index()
    {
        $departments = Department::orderBy('created_at', 'desc')->get();
        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Admin: show create form
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Admin: store new department
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
        ]);

        try {
            $data = $request->only(['name','icon','description']);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('departments','public');
            }

            Department::create($data);

            return redirect()->route('admin.departments.index')->with('success','Department added successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error','Error: '.$e->getMessage());
        }
    }

    /**
     * Admin: edit form
     */
    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Admin: update department
     */
    public function update(Request $request, Department $department)
     {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
        ]);

        try {
            $data = $request->only(['name','icon','description']);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('departments','public');
            }

            $department->update($data);

            return redirect()->route('admin.departments.index')->with('success','Department updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error','Error: '.$e->getMessage());
        }
     }

    /**
     * Admin: delete department
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return redirect()->route('admin.departments.index')->with('success','Department deleted.');
        } catch (Exception $e) {
            return redirect()->back()->with('error','Error: '.$e->getMessage());
        }
    }

    /* -------------------
       Frontend methods
       ------------------- */

    /**
     * Frontend: show all departments (dynamic)
     */
    public function showAllFrontend()
    {
        $departments = Department::orderBy('created_at','desc')->get();
        return view('pages.departments', compact('departments'));
    }

    public function search(Request $request)
{
    $query = $request->get('query');

    if (empty($query)) {
        return response()->json([]);
    }

    $departments = Department::where('name', 'LIKE', "%{$query}%")
        ->orWhere('description', 'LIKE', "%{$query}%")
        ->limit(10)
        ->get(['id', 'name', 'description', 'image']);

    return response()->json($departments);
}


}
