<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProductService
{
    protected string $cacheKey = 'products';
    protected int $cacheTtl = 3600; // 1 hour

    public function getPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $orgId = auth()->check() ? auth()->user()->organization_id : 0;
        
        return Product::with(['brand', 'category', 'unit'])->when($orgId, function ($query) use ($orgId) {
            $query->where('organization_id', $orgId);
        })->latest()->paginate($perPage);
    }

    public function getAll(): Collection
    {
        $orgId = auth()->check() ? auth()->user()->organization_id : 0;
        
        return Cache::remember("{$this->cacheKey}:org:{$orgId}:all", $this->cacheTtl, function () use ($orgId) {
            return Product::with(['brand', 'category', 'unit'])->when($orgId, function ($query) use ($orgId) {
                $query->where('organization_id', $orgId);
            })->orderBy('name')->get();
        });
    }

    public function getById(string $id): Product
    {
        return Product::with(['brand', 'category', 'unit'])->findOrFail($id);
    }

    public function create(array $data): Product
    {
        $data['organization_id'] = $data['organization_id'] ?? (auth()->user()->organization_id ?? 1);
        $data['status'] = isset($data['status']) ? 1 : 0;
        $data['is_batch_tracked'] = isset($data['is_batch_tracked']) ? true : false;
        $data['is_serial_tracked'] = isset($data['is_serial_tracked']) ? true : false;
        $data['is_asset'] = isset($data['is_asset']) ? true : false;
        
        // Generate a random string ID if none is provided
        if (empty($data['id'])) {
            $data['id'] = 'PRD-' . strtoupper(Str::random(10));
        }
        
        $product = Product::create($data);
        $this->clearCache();
        return $product;
    }

    public function update(string $id, array $data): Product
    {
        $product = $this->getById($id);
        
        if (isset($data['status'])) $data['status'] = 1; else $data['status'] = 0;
        if (isset($data['is_batch_tracked'])) $data['is_batch_tracked'] = true; else $data['is_batch_tracked'] = false;
        if (isset($data['is_serial_tracked'])) $data['is_serial_tracked'] = true; else $data['is_serial_tracked'] = false;
        if (isset($data['is_asset'])) $data['is_asset'] = true; else $data['is_asset'] = false;
        
        $product->update($data);
        $this->clearCache();
        return $product;
    }

    public function delete(string $id): void
    {
        $product = $this->getById($id);
        $product->delete();
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
