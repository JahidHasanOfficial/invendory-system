<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): JsonResponse
    {
        $products = $this->productService->getAll();
        return response()->json(['data' => $products]);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->productService->create($request->validated());
        return response()->json(['data' => $product, 'message' => 'Product created successfully.'], 201);
    }

    public function show(int $id): JsonResponse
    {
        $product = $this->productService->getById($id);
        return response()->json(['data' => $product]);
    }

    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $product = $this->productService->update($id, $request->validated());
        return response()->json(['data' => $product, 'message' => 'Product updated successfully.']);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->productService->delete($id);
        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
