<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use App\Services\ProductCategoryService;
use App\Services\BrandService;
use App\Services\UnitService;
use App\Models\Product;

class ProductController extends Controller
{
    protected ProductService $productService;
    protected ProductCategoryService $categoryService;
    protected BrandService $brandService;
    protected UnitService $unitService;

    public function __construct(
        ProductService $productService,
        ProductCategoryService $categoryService,
        BrandService $brandService,
        UnitService $unitService
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
        $this->unitService = $unitService;
    }

    public function index()
    {
        $products = $this->productService->getPaginated(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAll();
        $brands = $this->brandService->getAll();
        $units = $this->unitService->getAll();
        return view('admin.products.create', compact('categories', 'brands', 'units'));
    }

    public function store(StoreProductRequest $request)
    {
        $this->productService->create($request->validated());
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = $this->categoryService->getAll();
        $brands = $this->brandService->getAll();
        $units = $this->unitService->getAll();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'units'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productService->update($product->id, $request->validated());
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->productService->delete($product->id);
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
