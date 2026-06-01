@extends('layouts.app')

@section('title', 'Edit Lab')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Edit Lab</h2>
        <a href="{{ route('admin.labs.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Lab Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.labs.update', $lab->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="branch_id" class="form-label">Branch <span class="text-danger">*</span></label>
                        <select class="form-select @error('branch_id') is-invalid @enderror" id="branch_id" name="branch_id" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id', $lab->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        @error('branch_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label">Lab Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $lab->name) }}" placeholder="Enter lab name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="lab_code" class="form-label">Lab Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('lab_code') is-invalid @enderror" id="lab_code" name="lab_code" value="{{ old('lab_code', $lab->lab_code) }}" placeholder="Enter lab code" required>
                        @error('lab_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="lab_type" class="form-label">Lab Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('lab_type') is-invalid @enderror" id="lab_type" name="lab_type" required>
                            <option value="training_lab" {{ old('lab_type', $lab->lab_type) == 'training_lab' ? 'selected' : '' }}>Training Lab</option>
                            <option value="server_room" {{ old('lab_type', $lab->lab_type) == 'server_room' ? 'selected' : '' }}>Server Room</option>
                            <option value="instructor_room" {{ old('lab_type', $lab->lab_type) == 'instructor_room' ? 'selected' : '' }}>Instructor Room</option>
                            <option value="store_room" {{ old('lab_type', $lab->lab_type) == 'store_room' ? 'selected' : '' }}>Store Room</option>
                        </select>
                        @error('lab_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="capacity" class="form-label">Capacity <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity', $lab->capacity) }}" min="0" placeholder="Enter lab capacity" required>
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="floor" class="form-label">Floor</label>
                        <input type="text" class="form-control @error('floor') is-invalid @enderror" id="floor" name="floor" value="{{ old('floor', $lab->floor) }}" placeholder="Enter floor (e.g. 3rd Floor)">
                        @error('floor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="2" placeholder="Enter lab description">{{ old('description', $lab->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ $lab->status ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Update Lab</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
