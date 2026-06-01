<?php

namespace App\Services;

use App\Models\Repair;
use Illuminate\Support\Facades\Cache;

class RepairService
{
    protected string $cacheKey = 'repairs';
    protected int $cacheTtl = 3600; // 1 hour

    /**
     * Get paginated repairs with caching.
     */
    public function getPaginatedRepairs(int $perPage = 10, ?int $orgId = null)
    {
        $page = request()->get('page', 1);
        
        return Cache::remember("{$this->cacheKey}:org:{$orgId}:page:{$page}", $this->cacheTtl, function () use ($orgId, $perPage) {
            return Repair::with(['product', 'branch', 'createdBy'])
                ->when($orgId, function ($query) use ($orgId) {
                    $query->where('organization_id', $orgId);
                })->latest()->paginate($perPage);
        });
    }

    /**
     * Create a new repair.
     */
    public function createRepair(array $data, int $orgId)
    {
        $data['organization_id'] = $orgId;
        if (empty($data['repair_no'])) {
            $data['repair_no'] = 'REP-' . date('Ymd') . '-' . rand(1000, 9999);
        }
        $repair = Repair::create($data);
        $this->clearCache($orgId);
        return $repair;
    }

    /**
     * Update an existing repair.
     */
    public function updateRepair(Repair $repair, array $data, int $orgId)
    {
        $repair->update($data);
        $this->clearCache($orgId);
        return $repair;
    }

    /**
     * Delete a repair.
     */
    public function deleteRepair(Repair $repair, int $orgId)
    {
        $repair->delete();
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
