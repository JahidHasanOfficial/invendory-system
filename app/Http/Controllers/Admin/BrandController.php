<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = \App\Models\Brand::when(auth()->user()->organization_id, function ($query) {
            $query->where('organization_id', auth()->user()->organization_id);
        })->latest()->paginate(10);

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'description' => 'nullable|string',
            'status' => 'boolean',
        ]);

        \App\Models\Brand::create([
            'organization_id' => auth()->user()->organization_id ?? 1, // Default to 1 if null
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->has('status') ? true : false,
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    public function edit(\App\Models\Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, \App\Models\Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'description' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $brand->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->has('status') ? true : false,
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(\App\Models\Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }
}
