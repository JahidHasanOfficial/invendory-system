<?php

namespace App\Services;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductCategoryService
{
    protected string $cacheKey = 'categories';
    protected int $cacheTtl = 3600; // 1 hour

    public function getPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $orgId = auth()->check() ? auth()->user()->organization_id : 0;
        $page = request()->get('page', 1);
        
        return ProductCategory::with('parent')->when($orgId, function ($query) use ($orgId) {
                $query->where('organization_id', $orgId);
            })->latest()->paginate($perPage);
    }

    public function getAll(): Collection
    {
        $orgId = auth()->check() ? auth()->user()->organization_id : 0;
        
        return ProductCategory::when($orgId, function ($query) use ($orgId) {
            $query->where('organization_id', $orgId);
        })->orderBy('name')->get();
    }

    public function getById(int $id): ProductCategory
    {
        return ProductCategory::findOrFail($id);
    }

    public function create(array $data): ProductCategory
    {
        $data['organization_id'] = $data['organization_id'] ?? (auth()->user()->organization_id ?? 1);
        $data['status'] = isset($data['status']) ? true : false;
        
        $category = ProductCategory::create($data);
        $this->clearCache();
        return $category;
    }

    public function update(int $id, array $data): ProductCategory
    {
        $category = $this->getById($id);
        $data['status'] = isset($data['status']) ? true : false;
        
        $category->update($data);
        $this->clearCache();
        return $category;
    }

    public function delete(int $id): void
    {
        $category = $this->getById($id);
        $category->delete();
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

