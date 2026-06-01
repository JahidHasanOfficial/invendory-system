<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lab;
use App\Services\LabService;
use App\Services\BranchService;
use App\Http\Requests\StoreLabRequest;
use App\Http\Requests\UpdateLabRequest;
use Illuminate\Support\Facades\Auth;

class LabController extends Controller
{
    protected LabService $labService;
    protected BranchService $branchService;

    public function __construct(LabService $labService, BranchService $branchService)
    {
        $this->labService = $labService;
        $this->branchService = $branchService;
    }

    public function index()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $labs = $this->labService->getPaginatedLabs(10, $orgId);
        return view('admin.labs.index', compact('labs'));
    }

    public function create()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $branches = $this->branchService->getActiveBranches($orgId);
        return view('admin.labs.create', compact('branches'));
    }

    public function store(StoreLabRequest $request)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        
        $this->labService->createLab($data, $orgId);
        
        return redirect()->route('admin.labs.index')->with('success', 'Lab created successfully.');
    }

    public function edit(Lab $lab)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $branches = $this->branchService->getActiveBranches($orgId);
        return view('admin.labs.edit', compact('lab', 'branches'));
    }

    public function update(UpdateLabRequest $request, Lab $lab)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        $data['status'] = $request->has('status') ? 1 : 0;
        
        $this->labService->updateLab($lab, $data, $orgId);
        
        return redirect()->route('admin.labs.index')->with('success', 'Lab updated successfully.');
    }

    public function destroy(Lab $lab)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $this->labService->deleteLab($lab, $orgId);
        return redirect()->route('admin.labs.index')->with('success', 'Lab deleted successfully.');
    }
}
