<?php

namespace App\Services;

use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Cache;

class PurchaseOrderService
{
    protected string $cacheKey = 'purchase_orders';
    protected int $cacheTtl = 3600; // 1 hour

    /**
     * Get paginated purchase orders with caching.
     */
    public function getPaginatedPurchaseOrders(int $perPage = 10, ?int $orgId = null)
    {
        $page = request()->get('page', 1);
        
        return PurchaseOrder::with(['vendor', 'branch'])
                ->when($orgId, function ($query) use ($orgId) {
                    $query->where('organization_id', $orgId);
                })->latest()->paginate($perPage);
    }

    /**
     * Create a new purchase order.
     */
    public function createPurchaseOrder(array $data, int $orgId)
    {
        $data['organization_id'] = $orgId;
        // Generate a simple PO number if not provided
        if (empty($data['po_no'])) {
            $data['po_no'] = 'PO-' . date('Ymd') . '-' . rand(1000, 9999);
        }
        $po = PurchaseOrder::create($data);
        $this->clearCache($orgId);
        return $po;
    }

    /**
     * Update an existing purchase order.
     */
    public function updatePurchaseOrder(PurchaseOrder $purchaseOrder, array $data, int $orgId)
    {
        $purchaseOrder->update($data);
        $this->clearCache($orgId);
        return $purchaseOrder;
    }

    /**
     * Delete a purchase order.
     */
    public function deletePurchaseOrder(PurchaseOrder $purchaseOrder, int $orgId)
    {
        $purchaseOrder->delete();
        $this->clearCache($orgId);
    }

    /**
     * Clear cache.
     */
    public function clearCache(int $orgId): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Cache::forget("{$this->cacheKey}:org:{$orgId}:page:{$i}");
        }
    }
}

