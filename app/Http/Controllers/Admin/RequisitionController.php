<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Requisition;
use App\Services\RequisitionService;
use App\Services\BranchService;
use App\Http\Requests\StoreRequisitionRequest;
use App\Http\Requests\UpdateRequisitionRequest;
use Illuminate\Support\Facades\Auth;

class RequisitionController extends Controller
{
    protected RequisitionService $requisitionService;
    protected BranchService $branchService;

    public function __construct(
        RequisitionService $requisitionService,
        BranchService $branchService
    ) {
        $this->requisitionService = $requisitionService;
        $this->branchService = $branchService;
    }

    public function index()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $requisitions = $this->requisitionService->getPaginatedRequisitions(10, $orgId);
        return view('admin.requisitions.index', compact('requisitions'));
    }

    public function create()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $branches = $this->branchService->getActiveBranches($orgId);
        return view('admin.requisitions.create', compact('branches'));
    }

    public function store(StoreRequisitionRequest $request)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        $data['requested_by'] = Auth::id();
        
        $this->requisitionService->createRequisition($data, $orgId);
        
        return redirect()->route('admin.requisitions.index')->with('success', 'Requisition created successfully.');
    }

    public function edit(Requisition $requisition)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $branches = $this->branchService->getActiveBranches($orgId);
        return view('admin.requisitions.edit', compact('requisition', 'branches'));
    }

    public function update(UpdateRequisitionRequest $request, Requisition $requisition)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        
        $this->requisitionService->updateRequisition($requisition, $data, $orgId);
        
        return redirect()->route('admin.requisitions.index')->with('success', 'Requisition updated successfully.');
    }

    public function destroy(Requisition $requisition)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $this->requisitionService->deleteRequisition($requisition, $orgId);
        return redirect()->route('admin.requisitions.index')->with('success', 'Requisition deleted successfully.');
    }
}
