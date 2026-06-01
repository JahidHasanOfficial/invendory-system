<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Services\TransferService;
use App\Services\BranchService;
use App\Http\Requests\StoreTransferRequest;
use App\Http\Requests\UpdateTransferRequest;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    protected TransferService $transferService;
    protected BranchService $branchService;

    public function __construct(
        TransferService $transferService,
        BranchService $branchService
    ) {
        $this->transferService = $transferService;
        $this->branchService = $branchService;
    }

    public function index()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $transfers = $this->transferService->getPaginatedTransfers(10, $orgId);
        return view('admin.transfers.index', compact('transfers'));
    }

    public function create()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $branches = $this->branchService->getActiveBranches($orgId);
        return view('admin.transfers.create', compact('branches'));
    }

    public function store(StoreTransferRequest $request)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        $data['requested_by'] = Auth::id();
        
        $this->transferService->createTransfer($data, $orgId);
        
        return redirect()->route('admin.transfers.index')->with('success', 'Transfer created successfully.');
    }

    public function edit(Transfer $transfer)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $branches = $this->branchService->getActiveBranches($orgId);
        return view('admin.transfers.edit', compact('transfer', 'branches'));
    }

    public function update(UpdateTransferRequest $request, Transfer $transfer)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        
        $this->transferService->updateTransfer($transfer, $data, $orgId);
        
        return redirect()->route('admin.transfers.index')->with('success', 'Transfer updated successfully.');
    }

    public function destroy(Transfer $transfer)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $this->transferService->deleteTransfer($transfer, $orgId);
        return redirect()->route('admin.transfers.index')->with('success', 'Transfer deleted successfully.');
    }
}
