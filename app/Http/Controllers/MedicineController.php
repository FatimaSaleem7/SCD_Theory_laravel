<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;

class MedicineController extends Controller
{
    // Protect admin actions with auth middleware (adjust in routes if needed).
    public function __construct()
    {
        // optional: apply auth to admin resource routes only in routes/web.php
    }

    /**
     * Admin: list all medicines
     */
    public function index()
    {
        $medicines = Medicine::orderBy('created_at', 'desc')->get();
        return view('admin.medicines.index', compact('medicines'));
    }

    /**
     * Admin: show create form
     */
    public function create()
    {
        return view('admin.medicines.create');
    }

    /**
     * Admin: store new medicine
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'price' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
        ]);

        try {
            $data = $request->only(['name','category','price','description']);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('medicines','public');
            }

            Medicine::create($data);

            return redirect()->route('admin.medicines.index')->with('success','Medicine added successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error','Error: '.$e->getMessage());
        }
    }

    /**
     * Admin: edit form
     */
    public function edit(Medicine $medicine)
    {
        return view('admin.medicines.edit', compact('medicine'));
    }

    /**
     * Admin: update row
     */
    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'price' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
        ]);

        try {
            $data = $request->only(['name','category','price','description']);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('medicines','public');
            }

            $medicine->update($data);

            return redirect()->route('admin.medicines.index')->with('success','Medicine updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error','Error: '.$e->getMessage());
        }
    }

    /**
     * Admin: delete a medicine
     */
    public function destroy(Medicine $medicine)
    {
        try {
            $medicine->delete();
            return redirect()->route('admin.medicines.index')->with('success','Medicine deleted.');
        } catch (Exception $e) {
            return redirect()->back()->with('error','Error: '.$e->getMessage());
        }
    }

    /* -------------------
       Frontend methods
       ------------------- */

    /**
     * Frontend: show all medicines (replaces your hardcoded page)
     */
    public function showAllFrontend()
    {
        $medicines = Medicine::orderBy('created_at','desc')->get();
        return view('pages.medicines', compact('medicines'));
    }

    /**
     * Frontend: single medicine detail
     * uses numeric id (keeps your existing route signature)
     */
    public function showFrontend($id)
    {
        $product = Medicine::findOrFail($id);
        return view('pages.medicinedetail', compact('product'));
    }
}
