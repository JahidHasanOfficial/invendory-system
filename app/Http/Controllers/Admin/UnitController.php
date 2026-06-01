<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Services\UnitService;
use App\Models\Unit;

class UnitController extends Controller
{
    protected UnitService $unitService;

    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    public function index()
    {
        $units = $this->unitService->getPaginated(10);
        return view('admin.units.index', compact('units'));
    }

    public function create()
    {
        return view('admin.units.create');
    }

    public function store(StoreUnitRequest $request)
    {
        $this->unitService->create($request->validated());
        return redirect()->route('admin.units.index')->with('success', 'Unit created successfully.');
    }

    public function edit(Unit $unit)
    {
        return view('admin.units.edit', compact('unit'));
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $this->unitService->update($unit->id, $request->validated());
        return redirect()->route('admin.units.index')->with('success', 'Unit updated successfully.');
    }

    public function destroy(Unit $unit)
    {
        $this->unitService->delete($unit->id);
        return redirect()->route('admin.units.index')->with('success', 'Unit deleted successfully.');
    }
}
