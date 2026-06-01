<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetAssignment;
use App\Models\User;
use App\Services\AssetService;
use App\Services\BranchService;
use App\Services\LabService;
use App\Services\WorkstationService;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    protected AssetService $assetService;
    protected BranchService $branchService;
    protected LabService $labService;
    protected WorkstationService $workstationService;

    public function __construct(
        AssetService $assetService,
        BranchService $branchService,
        LabService $labService,
        WorkstationService $workstationService
    ) {
        $this->assetService = $assetService;
        $this->branchService = $branchService;
        $this->labService = $labService;
        $this->workstationService = $workstationService;
    }

    public function index()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $assets = $this->assetService->getPaginatedAssets(10, $orgId);
        return view('admin.assets.index', compact('assets'));
    }

    public function create()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $branches = $this->branchService->getActiveBranches($orgId);
        $labs = $this->labService->getActiveLabs($orgId);
        // Products query would normally go through ProductService
        $products = \App\Models\Product::all(); // Simplified for now
        $users = User::all();

        return view('admin.assets.create', compact('branches', 'labs', 'products', 'users'));
    }

    public function store(StoreAssetRequest $request)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        $data['assigned_by'] = Auth::id();
        
        $this->assetService->createAsset($data, $orgId);
        
        return redirect()->route('admin.assets.index')->with('success', 'Asset assigned successfully.');
    }

    public function edit(AssetAssignment $asset)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $branches = $this->branchService->getActiveBranches($orgId);
        $labs = $this->labService->getActiveLabs($orgId);
        $products = \App\Models\Product::all();
        $users = User::all();

        return view('admin.assets.edit', compact('asset', 'branches', 'labs', 'products', 'users'));
    }

    public function update(UpdateAssetRequest $request, AssetAssignment $asset)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        
        $this->assetService->updateAsset($asset, $data, $orgId);
        
        return redirect()->route('admin.assets.index')->with('success', 'Asset assignment updated successfully.');
    }

    public function destroy(AssetAssignment $asset)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $this->assetService->deleteAsset($asset, $orgId);
        return redirect()->route('admin.assets.index')->with('success', 'Asset assignment deleted successfully.');
    }
}
