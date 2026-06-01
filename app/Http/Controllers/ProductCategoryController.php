<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Services\ProductCategoryService;
use Illuminate\Http\JsonResponse;

class ProductCategoryController extends Controller
{
    protected ProductCategoryService $categoryService;

    public function __construct(ProductCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): JsonResponse
    {
        $categories = $this->categoryService->getAll();
        return response()->json(['data' => $categories]);
    }

    public function store(StoreProductCategoryRequest $request): JsonResponse
    {
        $category = $this->categoryService->create($request->validated());
        return response()->json(['data' => $category, 'message' => 'Category created successfully.'], 201);
    }

    public function show(int $id): JsonResponse
    {
        $category = $this->categoryService->getById($id);
        return response()->json(['data' => $category]);
    }

    public function update(UpdateProductCategoryRequest $request, int $id): JsonResponse
    {
        $category = $this->categoryService->update($id, $request->validated());
        return response()->json(['data' => $category, 'message' => 'Category updated successfully.']);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->categoryService->delete($id);
        return response()->json(['message' => 'Category deleted successfully.']);
    }
}
