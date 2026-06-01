@extends('layouts.app')

@section('title', 'Create Transfer')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Create Transfer</h2>
        <a href="{{ route('admin.transfers.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Transfer Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.transfers.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="transfer_no" class="form-label">Transfer Number</label>
                        <input type="text" class="form-control @error('transfer_no') is-invalid @enderror" id="transfer_no" name="transfer_no" value="{{ old('transfer_no') }}" placeholder="Auto-generated if left blank">
                        @error('transfer_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="from_branch_id" class="form-label">From Branch <span class="text-danger">*</span></label>
                        <select class="form-select @error('from_branch_id') is-invalid @enderror" id="from_branch_id" name="from_branch_id" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('from_branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        @error('from_branch_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="to_branch_id" class="form-label">To Branch <span class="text-danger">*</span></label>
                        <select class="form-select @error('to_branch_id') is-invalid @enderror" id="to_branch_id" name="to_branch_id" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('to_branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        @error('to_branch_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="transfer_date" class="form-label">Transfer Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('transfer_date') is-invalid @enderror" id="transfer_date" name="transfer_date" value="{{ old('transfer_date', date('Y-m-d')) }}" required>
                        @error('transfer_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="courier_name" class="form-label">Courier Name</label>
                        <input type="text" class="form-control @error('courier_name') is-invalid @enderror" id="courier_name" name="courier_name" value="{{ old('courier_name') }}" placeholder="Enter courier name">
                        @error('courier_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="in_transit" {{ old('status') == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                            <option value="received" {{ old('status') == 'received' ? 'selected' : '' }}>Received</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="courier_tracking_no" class="form-label">Courier Tracking No</label>
                        <input type="text" class="form-control @error('courier_tracking_no') is-invalid @enderror" id="courier_tracking_no" name="courier_tracking_no" value="{{ old('courier_tracking_no') }}" placeholder="Enter tracking number">
                        @error('courier_tracking_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="courier_cost" class="form-label">Courier Cost</label>
                        <input type="number" step="0.01" class="form-control @error('courier_cost') is-invalid @enderror" id="courier_cost" name="courier_cost" value="{{ old('courier_cost', 0) }}" min="0" placeholder="Enter courier cost">
                        @error('courier_cost')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2" placeholder="Enter any notes about this transfer">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Save Transfer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
