<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Services\UnitService;
use Illuminate\Http\JsonResponse;

class UnitController extends Controller
{
    protected UnitService $unitService;

    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    public function index(): JsonResponse
    {
        $units = $this->unitService->getAll();
        return response()->json(['data' => $units]);
    }

    public function store(StoreUnitRequest $request): JsonResponse
    {
        $unit = $this->unitService->create($request->validated());
        return response()->json(['data' => $unit, 'message' => 'Unit created successfully.'], 201);
    }

    public function show(int $id): JsonResponse
    {
        $unit = $this->unitService->getById($id);
        return response()->json(['data' => $unit]);
    }

    public function update(UpdateUnitRequest $request, int $id): JsonResponse
    {
        $unit = $this->unitService->update($id, $request->validated());
        return response()->json(['data' => $unit, 'message' => 'Unit updated successfully.']);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->unitService->delete($id);
        return response()->json(['message' => 'Unit deleted successfully.']);
    }
}
