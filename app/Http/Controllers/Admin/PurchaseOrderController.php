<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Services\PurchaseOrderService;
use App\Services\VendorService;
use App\Services\BranchService;
use App\Http\Requests\StorePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use Illuminate\Support\Facades\Auth;

class PurchaseOrderController extends Controller
{
    protected PurchaseOrderService $poService;
    protected VendorService $vendorService;
    protected BranchService $branchService;

    public function __construct(
        PurchaseOrderService $poService,
        VendorService $vendorService,
        BranchService $branchService
    ) {
        $this->poService = $poService;
        $this->vendorService = $vendorService;
        $this->branchService = $branchService;
    }

    public function index()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $purchaseOrders = $this->poService->getPaginatedPurchaseOrders(10, $orgId);
        return view('admin.purchase_orders.index', compact('purchaseOrders'));
    }

    public function create()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $vendors = $this->vendorService->getActiveVendors($orgId);
        $branches = $this->branchService->getActiveBranches($orgId);
        return view('admin.purchase_orders.create', compact('vendors', 'branches'));
    }

    public function store(StorePurchaseOrderRequest $request)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        
        $this->poService->createPurchaseOrder($data, $orgId);
        
        return redirect()->route('admin.purchase-orders.index')->with('success', 'Purchase Order created successfully.');
    }

    public function edit(PurchaseOrder $purchase_order)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $vendors = $this->vendorService->getActiveVendors($orgId);
        $branches = $this->branchService->getActiveBranches($orgId);
        return view('admin.purchase_orders.edit', compact('purchase_order', 'vendors', 'branches'));
    }

    public function update(UpdatePurchaseOrderRequest $request, PurchaseOrder $purchase_order)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        
        $this->poService->updatePurchaseOrder($purchase_order, $data, $orgId);
        
        return redirect()->route('admin.purchase-orders.index')->with('success', 'Purchase Order updated successfully.');
    }

    public function destroy(PurchaseOrder $purchase_order)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $this->poService->deletePurchaseOrder($purchase_order, $orgId);
        return redirect()->route('admin.purchase-orders.index')->with('success', 'Purchase Order deleted successfully.');
    }
}
