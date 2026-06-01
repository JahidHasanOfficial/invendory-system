<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoodsReceipt;
use App\Models\PurchaseOrder;
use App\Services\GoodsReceiptService;
use App\Services\BranchService;
use App\Http\Requests\StoreGoodsReceiptRequest;
use App\Http\Requests\UpdateGoodsReceiptRequest;
use Illuminate\Support\Facades\Auth;

class GoodsReceiptController extends Controller
{
    protected GoodsReceiptService $grService;
    protected BranchService $branchService;

    public function __construct(
        GoodsReceiptService $grService,
        BranchService $branchService
    ) {
        $this->grService = $grService;
        $this->branchService = $branchService;
    }

    public function index()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $goodsReceipts = $this->grService->getPaginatedGoodsReceipts(10, $orgId);
        return view('admin.goods_receipts.index', compact('goodsReceipts'));
    }

    public function create()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $branches = $this->branchService->getActiveBranches($orgId);
        // Simplified fetching of POs
        $purchaseOrders = PurchaseOrder::where('organization_id', $orgId)
                            ->whereIn('status', ['approved', 'sent'])
                            ->get();

        return view('admin.goods_receipts.create', compact('branches', 'purchaseOrders'));
    }

    public function store(StoreGoodsReceiptRequest $request)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        $data['received_by'] = Auth::id();
        
        $this->grService->createGoodsReceipt($data, $orgId);
        
        return redirect()->route('admin.goods-receipts.index')->with('success', 'Goods Receipt created successfully.');
    }

    public function edit(GoodsReceipt $goods_receipt)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $branches = $this->branchService->getActiveBranches($orgId);
        $purchaseOrders = PurchaseOrder::where('organization_id', $orgId)->get();

        return view('admin.goods_receipts.edit', compact('goods_receipt', 'branches', 'purchaseOrders'));
    }

    public function update(UpdateGoodsReceiptRequest $request, GoodsReceipt $goods_receipt)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        
        $this->grService->updateGoodsReceipt($goods_receipt, $data, $orgId);
        
        return redirect()->route('admin.goods-receipts.index')->with('success', 'Goods Receipt updated successfully.');
    }

    public function destroy(GoodsReceipt $goods_receipt)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $this->grService->deleteGoodsReceipt($goods_receipt, $orgId);
        return redirect()->route('admin.goods-receipts.index')->with('success', 'Goods Receipt deleted successfully.');
    }
}
