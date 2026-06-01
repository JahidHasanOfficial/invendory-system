@extends('layouts.app')

@section('title', 'Edit Workstation')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Edit Workstation</h2>
        <a href="{{ route('admin.workstations.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Workstation Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.workstations.update', $workstation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="lab_id" class="form-label">Lab <span class="text-danger">*</span></label>
                        <select class="form-select @error('lab_id') is-invalid @enderror" id="lab_id" name="lab_id" required>
                            <option value="">Select Lab</option>
                            @foreach($labs as $lab)
                                <option value="{{ $lab->id }}" {{ old('lab_id', $workstation->lab_id) == $lab->id ? 'selected' : '' }}>{{ $lab->name }} ({{ $lab->branch ? $lab->branch->name : '' }})</option>
                            @endforeach
                        </select>
                        @error('lab_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="workstation_code" class="form-label">Workstation Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('workstation_code') is-invalid @enderror" id="workstation_code" name="workstation_code" value="{{ old('workstation_code', $workstation->workstation_code) }}" placeholder="Enter workstation code" required>
                        @error('workstation_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="workstation_type" class="form-label">Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('workstation_type') is-invalid @enderror" id="workstation_type" name="workstation_type" required>
                            <option value="student" {{ old('workstation_type', $workstation->workstation_type) == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="instructor" {{ old('workstation_type', $workstation->workstation_type) == 'instructor' ? 'selected' : '' }}>Instructor</option>
                            <option value="server" {{ old('workstation_type', $workstation->workstation_type) == 'server' ? 'selected' : '' }}>Server</option>
                        </select>
                        @error('workstation_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="empty" {{ old('status', $workstation->status) == 'empty' ? 'selected' : '' }}>Empty</option>
                            <option value="occupied" {{ old('status', $workstation->status) == 'occupied' ? 'selected' : '' }}>Occupied</option>
                            <option value="under_repair" {{ old('status', $workstation->status) == 'under_repair' ? 'selected' : '' }}>Under Repair</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2" placeholder="Enter notes">{{ old('notes', $workstation->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Update Workstation</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
