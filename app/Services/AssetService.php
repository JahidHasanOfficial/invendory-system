<?php

namespace App\Services;

use App\Models\AssetAssignment;
use Illuminate\Support\Facades\Cache;

class AssetService
{
    protected string $cacheKey = 'assets';
    protected int $cacheTtl = 3600; // 1 hour

    /**
     * Get paginated assets (all types of assignments).
     */
    public function getPaginatedAssets(int $perPage = 10, ?int $orgId = null)
    {
        $page = request()->get('page', 1);
        
        return Cache::remember("{$this->cacheKey}:org:{$orgId}:page:{$page}", $this->cacheTtl, function () use ($orgId, $perPage) {
            return AssetAssignment::with(['product', 'branch', 'lab', 'workstation', 'assignedTo'])
                ->when($orgId, function ($query) use ($orgId) {
                    $query->whereHas('branch', function ($q) use ($orgId) {
                        $q->where('organization_id', $orgId);
                    });
                })->latest()->paginate($perPage);
        });
    }

    /**
     * Get paginated employee assets (only assigned to users).
     */
    public function getPaginatedEmployeeAssets(int $perPage = 10, ?int $orgId = null)
    {
        $page = request()->get('page', 1);
        
        return Cache::remember("{$this->cacheKey}:employee:org:{$orgId}:page:{$page}", $this->cacheTtl, function () use ($orgId, $perPage) {
            return AssetAssignment::with(['product', 'branch', 'assignedTo'])
                ->whereNotNull('assigned_to_user_id')
                ->where('assignment_type', 'permanent') // Or however they distinguish employee vs lab
                ->when($orgId, function ($query) use ($orgId) {
                    $query->whereHas('branch', function ($q) use ($orgId) {
                        $q->where('organization_id', $orgId);
                    });
                })->latest()->paginate($perPage);
        });
    }

    /**
     * Create a new asset assignment.
     */
    public function createAsset(array $data, int $orgId)
    {
        $asset = AssetAssignment::create($data);
        $this->clearCache($orgId);
        return $asset;
    }

    /**
     * Update an existing asset assignment.
     */
    public function updateAsset(AssetAssignment $asset, array $data, int $orgId)
    {
        $asset->update($data);
        $this->clearCache($orgId);
        return $asset;
    }

    /**
     * Delete an asset assignment.
     */
    public function deleteAsset(AssetAssignment $asset, int $orgId)
    {
        $asset->delete();
        $this->clearCache($orgId);
    }

    /**
     * Clear asset cache.
     */
    public function clearCache(int $orgId): void
    {
        // Clear paginated caches (brute force approach for file cache)
        for ($i = 1; $i <= 20; $i++) {
            Cache::forget("{$this->cacheKey}:org:{$orgId}:page:{$i}");
            Cache::forget("{$this->cacheKey}:employee:org:{$orgId}:page:{$i}");
        }
    }
}
