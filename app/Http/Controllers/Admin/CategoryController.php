<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Services\ProductCategoryService;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    protected ProductCategoryService $categoryService;

    public function __construct(ProductCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getPaginated(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = $this->categoryService->getAll();
        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(StoreProductCategoryRequest $request)
    {
        $this->categoryService->create($request->validated());
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(ProductCategory $category)
    {
        $parentCategories = $this->categoryService->getAll()->where('id', '!=', $category->id);
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $category)
    {
        $this->categoryService->update($category->id, $request->validated());
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(ProductCategory $category)
    {
        $this->categoryService->delete($category->id);
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
