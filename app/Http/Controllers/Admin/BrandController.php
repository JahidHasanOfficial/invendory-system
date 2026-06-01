<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Services\BrandService;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected BrandService $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index()
    {
        $brands = $this->brandService->getPaginated(10);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(StoreBrandRequest $request)
    {
        $this->brandService->create($request->validated());
        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $this->brandService->update($brand->id, $request->validated());
        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $this->brandService->delete($brand->id);
        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }
}
