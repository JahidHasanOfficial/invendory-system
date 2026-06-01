<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Services\BrandService;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    protected BrandService $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index(): JsonResponse
    {
        $brands = $this->brandService->getAll();
        return response()->json(['data' => $brands]);
    }

    public function store(StoreBrandRequest $request): JsonResponse
    {
        $brand = $this->brandService->create($request->validated());
        return response()->json(['data' => $brand, 'message' => 'Brand created successfully.'], 201);
    }

    public function show(int $id): JsonResponse
    {
        $brand = $this->brandService->getById($id);
        return response()->json(['data' => $brand]);
    }

    public function update(UpdateBrandRequest $request, int $id): JsonResponse
    {
        $brand = $this->brandService->update($id, $request->validated());
        return response()->json(['data' => $brand, 'message' => 'Brand updated successfully.']);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->brandService->delete($id);
        return response()->json(['message' => 'Brand deleted successfully.']);
    }
}
