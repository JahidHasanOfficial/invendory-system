<?php

namespace App\Services;

use App\Models\Unit;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UnitService
{
    protected string $cacheKey = 'units';
    protected int $cacheTtl = 3600; // 1 hour

    public function getPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $orgId = auth()->check() ? auth()->user()->organization_id : 0;
        $page = request()->get('page', 1);
        
        return Cache::remember("{$this->cacheKey}:org:{$orgId}:page:{$page}", $this->cacheTtl, function () use ($orgId, $perPage) {
            return Unit::when($orgId, function ($query) use ($orgId) {
                $query->where('organization_id', $orgId);
            })->latest()->paginate($perPage);
        });
    }

    public function getAll(): Collection
    {
        $orgId = auth()->check() ? auth()->user()->organization_id : 0;
        
        return Cache::remember("{$this->cacheKey}:org:{$orgId}:all", $this->cacheTtl, function () use ($orgId) {
            return Unit::when($orgId, function ($query) use ($orgId) {
                $query->where('organization_id', $orgId);
            })->orderBy('full_name')->get();
        });
    }

    public function getById(int $id): Unit
    {
        return Unit::findOrFail($id);
    }

    public function create(array $data): Unit
    {
        $data['organization_id'] = $data['organization_id'] ?? (auth()->user()->organization_id ?? 1);
        $data['status'] = isset($data['status']) ? 1 : 0;
        
        $unit = Unit::create($data);
        $this->clearCache();
        return $unit;
    }

    public function update(int $id, array $data): Unit
    {
        $unit = $this->getById($id);
        $data['status'] = isset($data['status']) ? 1 : 0;
        
        $unit->update($data);
        $this->clearCache();
        return $unit;
    }

    public function delete(int $id): void
    {
        $unit = $this->getById($id);
        $unit->delete();
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        $orgId = auth()->check() ? auth()->user()->organization_id : 0;
        Cache::forget("{$this->cacheKey}:org:{$orgId}:all");
        
        for ($i = 1; $i <= 10; $i++) {
            Cache::forget("{$this->cacheKey}:org:{$orgId}:page:{$i}");
        }
    }
}
