<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workstation;
use App\Services\WorkstationService;
use App\Services\LabService;
use App\Http\Requests\StoreWorkstationRequest;
use App\Http\Requests\UpdateWorkstationRequest;
use Illuminate\Support\Facades\Auth;

class WorkstationController extends Controller
{
    protected WorkstationService $workstationService;
    protected LabService $labService;

    public function __construct(WorkstationService $workstationService, LabService $labService)
    {
        $this->workstationService = $workstationService;
        $this->labService = $labService;
    }

    public function index()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $workstations = $this->workstationService->getPaginatedWorkstations(10, $orgId);
        return view('admin.workstations.index', compact('workstations'));
    }

    public function create()
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $labs = $this->labService->getActiveLabs($orgId);
        return view('admin.workstations.create', compact('labs'));
    }

    public function store(StoreWorkstationRequest $request)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        
        $this->workstationService->createWorkstation($data, $orgId);
        
        return redirect()->route('admin.workstations.index')->with('success', 'Workstation created successfully.');
    }

    public function edit(Workstation $workstation)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $labs = $this->labService->getActiveLabs($orgId);
        return view('admin.workstations.edit', compact('workstation', 'labs'));
    }

    public function update(UpdateWorkstationRequest $request, Workstation $workstation)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $data = $request->validated();
        
        $this->workstationService->updateWorkstation($workstation, $data, $orgId);
        
        return redirect()->route('admin.workstations.index')->with('success', 'Workstation updated successfully.');
    }

    public function destroy(Workstation $workstation)
    {
        $orgId = Auth::user()->organization_id ?? 1;
        $this->workstationService->deleteWorkstation($workstation, $orgId);
        return redirect()->route('admin.workstations.index')->with('success', 'Workstation deleted successfully.');
    }
}
