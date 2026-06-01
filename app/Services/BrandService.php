<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BrandService
{
    protected string $cacheKey = 'brands';
    protected int $cacheTtl = 3600; // 1 hour

    public function getPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $orgId = auth()->user()->organization_id ?? 0;
        $page = request()->get('page', 1);
        
        return Cache::remember("{$this->cacheKey}:org:{$orgId}:page:{$page}", $this->cacheTtl, function () use ($orgId, $perPage) {
            return Brand::when($orgId, function ($query) use ($orgId) {
                $query->where('organization_id', $orgId);
            })->latest()->paginate($perPage);
        });
    }

    public function getAll(): Collection
    {
        $orgId = auth()->user()->organization_id ?? 0;
        
        return Cache::remember("{$this->cacheKey}:org:{$orgId}:all", $this->cacheTtl, function () use ($orgId) {
            return Brand::when($orgId, function ($query) use ($orgId) {
                $query->where('organization_id', $orgId);
            })->orderBy('name')->get();
        });
    }

    public function getById(int $id): Brand
    {
        return Brand::findOrFail($id);
    }

    public function create(array $data): Brand
    {
        $data['organization_id'] = $data['organization_id'] ?? (auth()->user()->organization_id ?? 1);
        
        $brand = Brand::create($data);
        $this->clearCache();
        return $brand;
    }

    public function update(int $id, array $data): Brand
    {
        $brand = $this->getById($id);
        
        $brand->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'status' => isset($data['status']) ? true : false,
        ]);
        
        $this->clearCache();
        return $brand;
    }

    public function delete(int $id): void
    {
        $brand = $this->getById($id);
        $brand->delete();
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        // Ideally use cache tags here, but since standard cache driver might be file/database:
        // Cache::tags(['brands'])->flush();
        // Since we can't easily clear all paginated pages without tags, we can flush entire cache
        // or just accept that we need Redis for tags. We'll clear the 'all' cache for now.
        $orgId = auth()->check() ? auth()->user()->organization_id : 0;
        Cache::forget("{$this->cacheKey}:org:{$orgId}:all");
        
        // As a workaround without tags, we might just clear the first few pages
        for ($i = 1; $i <= 10; $i++) {
            Cache::forget("{$this->cacheKey}:org:{$orgId}:page:{$i}");
        }
    }
}
