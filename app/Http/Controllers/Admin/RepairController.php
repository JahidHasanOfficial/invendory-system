<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use App\Models\Product;
use App\Services\RepairService;
use App\Services\BranchService;
use App\Http\Requests\StoreRepairRequest;
use App\Http\Requests\UpdateRepairRequest;
use Illuminate\Support\Facades\Auth;

class RepairController extends Controller
{
    protected RepairService $repairService;
    protected BranchService $branchService;

    public function __construct(
        RepairService $repairService,
        BranchService $branchService
    ) {
        $this->repairService = $repairService;
        $this->branchService = $branchService;
    }

    public function index()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $repairs = $this->repairService->getPaginatedRepairs(10, $orgId);
        return view('admin.repairs.index', compact('repairs'));
    }

    public function create()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $branches = $this->branchService->getActiveBranches($orgId);
        $products = Product::where('organization_id', $orgId)->get();
        return view('admin.repairs.create', compact('branches', 'products'));
    }

    public function store(StoreRepairRequest $request)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        $data['created_by'] = Auth::id();
        
        $this->repairService->createRepair($data, $orgId);
        
        return redirect()->route('admin.repairs.index')->with('success', 'Repair created successfully.');
    }

    public function edit(Repair $repair)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $branches = $this->branchService->getActiveBranches($orgId);
        $products = Product::where('organization_id', $orgId)->get();
        return view('admin.repairs.edit', compact('repair', 'branches', 'products'));
    }

    public function update(UpdateRepairRequest $request, Repair $repair)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        
        $this->repairService->updateRepair($repair, $data, $orgId);
        
        return redirect()->route('admin.repairs.index')->with('success', 'Repair updated successfully.');
    }

    public function destroy(Repair $repair)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $this->repairService->deleteRepair($repair, $orgId);
        return redirect()->route('admin.repairs.index')->with('success', 'Repair deleted successfully.');
    }
}
