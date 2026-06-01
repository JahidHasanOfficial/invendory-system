<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetAssignment;
use App\Services\AssetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAssetController extends Controller
{
    protected AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    public function index()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $employeeAssets = $this->assetService->getPaginatedEmployeeAssets(10, $orgId);
        return view('admin.employee_assets.index', compact('employeeAssets'));
    }

    // Usually Employee Assets just redirects create/edit to the main Asset tracking system,
    // but we can provide basic routing if needed. For now, we only need index to view them.
}
