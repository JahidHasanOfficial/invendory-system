<?php

namespace App\Services;

use App\Models\Branch;
use Illuminate\Support\Facades\Cache;

class BranchService
{
    protected string $cacheKey = 'branches';
    protected int $cacheTtl = 3600; // 1 hour

    /**
     * Get paginated branches with caching.
     */
    public function getPaginatedBranches(int $perPage = 10, ?int $orgId = null)
    {
        $page = request()->get('page', 1);
        
        return Cache::remember("{$this->cacheKey}:org:{$orgId}:page:{$page}", $this->cacheTtl, function () use ($orgId, $perPage) {
            return Branch::when($orgId, function ($query) use ($orgId) {
                $query->where('organization_id', $orgId);
            })->latest()->paginate($perPage);
        });
    }

    /**
     * Get all active branches (for dropdowns).
     */
    public function getActiveBranches(?int $orgId = null)
    {
        return Cache::remember("{$this->cacheKey}:active:org:{$orgId}", $this->cacheTtl, function () use ($orgId) {
            return Branch::where('status', 1)
                ->when($orgId, function ($query) use ($orgId) {
                    $query->where('organization_id', $orgId);
                })->orderBy('name')->get();
        });
    }

    /**
     * Create a new branch.
     */
    public function createBranch(array $data)
    {
        $branch = Branch::create($data);
        $this->clearCache($branch->organization_id);
        return $branch;
    }

    /**
     * Update an existing branch.
     */
    public function updateBranch(Branch $branch, array $data)
    {
        $branch->update($data);
        $this->clearCache($branch->organization_id);
        return $branch;
    }

    /**
     * Delete a branch.
     */
    public function deleteBranch(Branch $branch)
    {
        $orgId = $branch->organization_id;
        $branch->delete();
        $this->clearCache($orgId);
    }

    /**
     * Clear branch cache.
     */
    public function clearCache(?int $orgId = null): void
    {
        Cache::forget("{$this->cacheKey}:active:org:{$orgId}");
        
        // Clear paginated caches (brute force approach for file cache)
        for ($i = 1; $i <= 20; $i++) {
            Cache::forget("{$this->cacheKey}:org:{$orgId}:page:{$i}");
        }
    }
}
