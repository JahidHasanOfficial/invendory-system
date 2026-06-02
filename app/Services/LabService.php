<?php

namespace App\Services;

use App\Models\Lab;
use Illuminate\Support\Facades\Cache;

class LabService
{
    protected string $cacheKey = 'labs';
    protected int $cacheTtl = 3600; // 1 hour

    /**
     * Get paginated labs with caching.
     */
    public function getPaginatedLabs(int $perPage = 10, ?int $orgId = null)
    {
        $page = request()->get('page', 1);
        
        return Lab::with('branch')->when($orgId, function ($query) use ($orgId) {
                $query->whereHas('branch', function ($q) use ($orgId) {
                    $q->where('organization_id', $orgId);
                });
            })->latest()->paginate($perPage);
    }

    /**
     * Get all active labs (for dropdowns).
     */
    public function getActiveLabs(?int $orgId = null)
    {
        return Cache::remember("{$this->cacheKey}:active:org:{$orgId}", $this->cacheTtl, function () use ($orgId) {
            return Lab::with('branch')->where('status', 1)
                ->when($orgId, function ($query) use ($orgId) {
                    $query->whereHas('branch', function ($q) use ($orgId) {
                        $q->where('organization_id', $orgId);
                    });
                })->orderBy('name')->get();
        });
    }

    /**
     * Create a new lab.
     */
    public function createLab(array $data, int $orgId)
    {
        $lab = Lab::create($data);
        $this->clearCache($orgId);
        return $lab;
    }

    /**
     * Update an existing lab.
     */
    public function updateLab(Lab $lab, array $data, int $orgId)
    {
        $lab->update($data);
        $this->clearCache($orgId);
        return $lab;
    }

    /**
     * Delete a lab.
     */
    public function deleteLab(Lab $lab, int $orgId)
    {
        $lab->delete();
        $this->clearCache($orgId);
    }

    /**
     * Clear lab cache.
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

