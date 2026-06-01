<?php

namespace App\Services;

use App\Models\Transfer;
use Illuminate\Support\Facades\Cache;

class TransferService
{
    protected string $cacheKey = 'transfers';
    protected int $cacheTtl = 3600; // 1 hour

    /**
     * Get paginated transfers with caching.
     */
    public function getPaginatedTransfers(int $perPage = 10, ?int $orgId = null)
    {
        $page = request()->get('page', 1);
        
        return Cache::remember("{$this->cacheKey}:org:{$orgId}:page:{$page}", $this->cacheTtl, function () use ($orgId, $perPage) {
            return Transfer::with(['fromBranch', 'toBranch', 'requestedBy'])
                ->when($orgId, function ($query) use ($orgId) {
                    $query->where('organization_id', $orgId);
                })->latest()->paginate($perPage);
        });
    }

    /**
     * Create a new transfer.
     */
    public function createTransfer(array $data, int $orgId)
    {
        $data['organization_id'] = $orgId;
        if (empty($data['transfer_no'])) {
            $data['transfer_no'] = 'TR-' . date('Ymd') . '-' . rand(1000, 9999);
        }
        $transfer = Transfer::create($data);
        $this->clearCache($orgId);
        return $transfer;
    }

    /**
     * Update an existing transfer.
     */
    public function updateTransfer(Transfer $transfer, array $data, int $orgId)
    {
        $transfer->update($data);
        $this->clearCache($orgId);
        return $transfer;
    }

    /**
     * Delete a transfer.
     */
    public function deleteTransfer(Transfer $transfer, int $orgId)
    {
        $transfer->delete();
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
