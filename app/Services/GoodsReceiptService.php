<?php

namespace App\Services;

use App\Models\GoodsReceipt;
use Illuminate\Support\Facades\Cache;

class GoodsReceiptService
{
    protected string $cacheKey = 'goods_receipts';
    protected int $cacheTtl = 3600; // 1 hour

    /**
     * Get paginated goods receipts with caching.
     */
    public function getPaginatedGoodsReceipts(int $perPage = 10, ?int $orgId = null)
    {
        $page = request()->get('page', 1);
        
        return GoodsReceipt::with(['purchaseOrder', 'branch', 'receivedBy'])
                ->when($orgId, function ($query) use ($orgId) {
                    $query->where('organization_id', $orgId);
                })->latest()->paginate($perPage);
    }

    /**
     * Create a new goods receipt.
     */
    public function createGoodsReceipt(array $data, int $orgId)
    {
        $data['organization_id'] = $orgId;
        if (empty($data['gr_no'])) {
            $data['gr_no'] = 'GR-' . date('Ymd') . '-' . rand(1000, 9999);
        }
        $gr = GoodsReceipt::create($data);
        $this->clearCache($orgId);
        return $gr;
    }

    /**
     * Update an existing goods receipt.
     */
    public function updateGoodsReceipt(GoodsReceipt $goodsReceipt, array $data, int $orgId)
    {
        $goodsReceipt->update($data);
        $this->clearCache($orgId);
        return $goodsReceipt;
    }

    /**
     * Delete a goods receipt.
     */
    public function deleteGoodsReceipt(GoodsReceipt $goodsReceipt, int $orgId)
    {
        $goodsReceipt->delete();
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

