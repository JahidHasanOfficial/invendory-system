<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Services\VendorService;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    protected VendorService $vendorService;

    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;
    }

    public function index()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $vendors = $this->vendorService->getPaginatedVendors(10, $orgId);
        return view('admin.vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('admin.vendors.create');
    }

    public function store(StoreVendorRequest $request)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        $data['status'] = $request->has('status') ? 1 : 0;
        
        $this->vendorService->createVendor($data, $orgId);
        
        return redirect()->route('admin.vendors.index')->with('success', 'Vendor created successfully.');
    }

    public function edit(Vendor $vendor)
    {
        return view('admin.vendors.edit', compact('vendor'));
    }

    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        $data['status'] = $request->has('status') ? 1 : 0;
        
        $this->vendorService->updateVendor($vendor, $data, $orgId);
        
        return redirect()->route('admin.vendors.index')->with('success', 'Vendor updated successfully.');
    }

    public function destroy(Vendor $vendor)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $this->vendorService->deleteVendor($vendor, $orgId);
        return redirect()->route('admin.vendors.index')->with('success', 'Vendor deleted successfully.');
    }
}
