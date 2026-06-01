@extends('layouts.app')

@section('title', 'Edit Repair')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Edit Repair</h2>
        <a href="{{ route('admin.repairs.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Repair Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.repairs.update', $repair->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="repair_no" class="form-label">Repair Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('repair_no') is-invalid @enderror" id="repair_no" name="repair_no" value="{{ old('repair_no', $repair->repair_no) }}" placeholder="Enter repair number" required>
                        @error('repair_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="product_id" class="form-label">Product <span class="text-danger">*</span></label>
                        <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id', $repair->product_id) == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="from_branch_id" class="form-label">From Branch <span class="text-danger">*</span></label>
                        <select class="form-select @error('from_branch_id') is-invalid @enderror" id="from_branch_id" name="from_branch_id" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('from_branch_id', $repair->from_branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        @error('from_branch_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="batch_no" class="form-label">Batch No</label>
                        <input type="text" class="form-control @error('batch_no') is-invalid @enderror" id="batch_no" name="batch_no" value="{{ old('batch_no', $repair->batch_no) }}" placeholder="Enter batch number">
                        @error('batch_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="serial_no" class="form-label">Serial No</label>
                        <input type="text" class="form-control @error('serial_no') is-invalid @enderror" id="serial_no" name="serial_no" value="{{ old('serial_no', $repair->serial_no) }}" placeholder="Enter serial number">
                        @error('serial_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="pending_receipt" {{ old('status', $repair->status) == 'pending_receipt' ? 'selected' : '' }}>Pending Receipt</option>
                            <option value="in_repair" {{ old('status', $repair->status) == 'in_repair' ? 'selected' : '' }}>In Repair</option>
                            <option value="repaired" {{ old('status', $repair->status) == 'repaired' ? 'selected' : '' }}>Repaired</option>
                            <option value="returned" {{ old('status', $repair->status) == 'returned' ? 'selected' : '' }}>Returned</option>
                            <option value="beyond_repair" {{ old('status', $repair->status) == 'beyond_repair' ? 'selected' : '' }}>Beyond Repair</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="fault_description" class="form-label">Fault Description</label>
                        <textarea class="form-control @error('fault_description') is-invalid @enderror" id="fault_description" name="fault_description" rows="2" placeholder="Describe the fault or issue">{{ old('fault_description', $repair->fault_description) }}</textarea>
                        @error('fault_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="font-weight-bold text-secondary mb-3">Repair Status Details</h6>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="received_at_head_office" class="form-label">Received At HO</label>
                        <input type="date" class="form-control @error('received_at_head_office') is-invalid @enderror" id="received_at_head_office" name="received_at_head_office" value="{{ old('received_at_head_office', $repair->received_at_head_office) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="repaired_by" class="form-label">Repaired By</label>
                        <input type="text" class="form-control @error('repaired_by') is-invalid @enderror" id="repaired_by" name="repaired_by" value="{{ old('repaired_by', $repair->repaired_by) }}" placeholder="Enter repairer name">
                    </div>
                    <div class="col-md-3">
                        <label for="repaired_date" class="form-label">Repaired Date</label>
                        <input type="date" class="form-control @error('repaired_date') is-invalid @enderror" id="repaired_date" name="repaired_date" value="{{ old('repaired_date', $repair->repaired_date) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="repair_cost" class="form-label">Repair Cost</label>
                        <input type="number" step="0.01" class="form-control @error('repair_cost') is-invalid @enderror" id="repair_cost" name="repair_cost" value="{{ old('repair_cost', $repair->repair_cost) }}" min="0" placeholder="Enter cost">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2" placeholder="Enter any internal notes">{{ old('notes', $repair->notes) }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Update Repair</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
