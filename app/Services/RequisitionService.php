<?php

namespace App\Services;

use App\Models\Requisition;
use Illuminate\Support\Facades\Cache;

class RequisitionService
{
    protected string $cacheKey = 'requisitions';
    protected int $cacheTtl = 3600; // 1 hour

    /**
     * Get paginated requisitions with caching.
     */
    public function getPaginatedRequisitions(int $perPage = 10, ?int $orgId = null)
    {
        $page = request()->get('page', 1);
        
        return Cache::remember("{$this->cacheKey}:org:{$orgId}:page:{$page}", $this->cacheTtl, function () use ($orgId, $perPage) {
            return Requisition::with(['branch', 'requestedBy'])
                ->when($orgId, function ($query) use ($orgId) {
                    $query->where('organization_id', $orgId);
                })->latest()->paginate($perPage);
        });
    }

    /**
     * Create a new requisition.
     */
    public function createRequisition(array $data, int $orgId)
    {
        $data['organization_id'] = $orgId;
        if (empty($data['req_no'])) {
            $data['req_no'] = 'REQ-' . date('Ymd') . '-' . rand(1000, 9999);
        }
        $req = Requisition::create($data);
        $this->clearCache($orgId);
        return $req;
    }

    /**
     * Update an existing requisition.
     */
    public function updateRequisition(Requisition $requisition, array $data, int $orgId)
    {
        $requisition->update($data);
        $this->clearCache($orgId);
        return $requisition;
    }

    /**
     * Delete a requisition.
     */
    public function deleteRequisition(Requisition $requisition, int $orgId)
    {
        $requisition->delete();
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
