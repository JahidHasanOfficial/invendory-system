<?php

namespace App\Services;

use App\Models\Vendor;
use Illuminate\Support\Facades\Cache;

class VendorService
{
    protected string $cacheKey = 'vendors';
    protected int $cacheTtl = 3600; // 1 hour

    /**
     * Get paginated vendors with caching.
     */
    public function getPaginatedVendors(int $perPage = 10, ?int $orgId = null)
    {
        $page = request()->get('page', 1);
        
        return Cache::remember("{$this->cacheKey}:org:{$orgId}:page:{$page}", $this->cacheTtl, function () use ($orgId, $perPage) {
            return Vendor::when($orgId, function ($query) use ($orgId) {
                $query->where('organization_id', $orgId);
            })->latest()->paginate($perPage);
        });
    }

    /**
     * Get active vendors.
     */
    public function getActiveVendors(?int $orgId = null)
    {
        return Cache::remember("{$this->cacheKey}:active:org:{$orgId}", $this->cacheTtl, function () use ($orgId) {
            return Vendor::where('status', 1)->when($orgId, function ($query) use ($orgId) {
                $query->where('organization_id', $orgId);
            })->orderBy('name')->get();
        });
    }

    /**
     * Create a new vendor.
     */
    public function createVendor(array $data, int $orgId)
    {
        $data['organization_id'] = $orgId;
        $vendor = Vendor::create($data);
        $this->clearCache($orgId);
        return $vendor;
    }

    /**
     * Update an existing vendor.
     */
    public function updateVendor(Vendor $vendor, array $data, int $orgId)
    {
        $vendor->update($data);
        $this->clearCache($orgId);
        return $vendor;
    }

    /**
     * Delete a vendor.
     */
    public function deleteVendor(Vendor $vendor, int $orgId)
    {
        $vendor->delete();
        $this->clearCache($orgId);
    }

    /**
     * Clear vendor cache.
     */
    public function clearCache(int $orgId): void
    {
        Cache::forget("{$this->cacheKey}:active:org:{$orgId}");
        
        // Clear paginated caches (brute force approach for file cache)
        for ($i = 1; $i <= 20; $i++) {
            Cache::forget("{$this->cacheKey}:org:{$orgId}:page:{$i}");
        }
    }
}
