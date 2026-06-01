<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Branch;
use App\Services\BranchService;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    protected BranchService $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    public function index()
    {
        $orgId = Auth::user()->organization_id ?? 1; // Fallback to 1 for testing
        $branches = $this->branchService->getPaginatedBranches(10, $orgId);
        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function store(StoreBranchRequest $request)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = array_merge($request->validated(), ['organization_id' => $orgId]);
        
        $this->branchService->createBranch($data);
        
        return redirect()->route('admin.branches.index')->with('success', 'Branch created successfully.');
    }

    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $data = $request->validated();
        $data['status'] = $request->has('status') ? 1 : 0;
        
        $this->branchService->updateBranch($branch, $data);
        
        return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully.');
    }

    public function destroy(Branch $branch)
    {
        $this->branchService->deleteBranch($branch);
        return redirect()->route('admin.branches.index')->with('success', 'Branch deleted successfully.');
    }
}
