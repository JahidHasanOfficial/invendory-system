<?php

namespace App\Services;

use App\Models\Workstation;
use Illuminate\Support\Facades\Cache;

class WorkstationService
{
    protected string $cacheKey = 'workstations';
    protected int $cacheTtl = 3600; // 1 hour

    /**
     * Get paginated workstations with caching.
     */
    public function getPaginatedWorkstations(int $perPage = 10, ?int $orgId = null)
    {
        $page = request()->get('page', 1);
        
        return Workstation::with('lab.branch')->when($orgId, function ($query) use ($orgId) {
                $query->whereHas('lab.branch', function ($q) use ($orgId) {
                    $q->where('organization_id', $orgId);
                });
            })->latest()->paginate($perPage);
    }

    /**
     * Get active workstations for a specific lab.
     */
    public function getActiveWorkstationsByLab(int $labId)
    {
        return Cache::remember("{$this->cacheKey}:active:lab:{$labId}", $this->cacheTtl, function () use ($labId) {
            return Workstation::where('lab_id', $labId)
                ->whereIn('status', ['empty', 'occupied']) // Exclude 'under_repair'
                ->orderBy('workstation_code')
                ->get();
        });
    }

    /**
     * Create a new workstation.
     */
    public function createWorkstation(array $data, int $orgId)
    {
        $workstation = Workstation::create($data);
        $this->clearCache($orgId, $workstation->lab_id);
        return $workstation;
    }

    /**
     * Update an existing workstation.
     */
    public function updateWorkstation(Workstation $workstation, array $data, int $orgId)
    {
        $oldLabId = $workstation->lab_id;
        $workstation->update($data);
        
        $this->clearCache($orgId, $oldLabId);
        if ($oldLabId != $workstation->lab_id) {
            $this->clearCache($orgId, $workstation->lab_id);
        }
        
        return $workstation;
    }

    /**
     * Delete a workstation.
     */
    public function deleteWorkstation(Workstation $workstation, int $orgId)
    {
        $labId = $workstation->lab_id;
        $workstation->delete();
        $this->clearCache($orgId, $labId);
    }

    /**
     * Clear workstation cache.
     */
    public function clearCache(int $orgId, ?int $labId = null): void
    {
        if ($labId) {
            Cache::forget("{$this->cacheKey}:active:lab:{$labId}");
        }
        
        // Clear paginated caches (brute force approach for file cache)
        for ($i = 1; $i <= 20; $i++) {
            Cache::forget("{$this->cacheKey}:org:{$orgId}:page:{$i}");
        }
    }
}

