@extends('layouts.app')

@section('title', 'Create Requisition')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Create Requisition</h2>
        <a href="{{ route('admin.requisitions.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Requisition Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.requisitions.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="req_no" class="form-label">Requisition Number</label>
                        <input type="text" class="form-control @error('req_no') is-invalid @enderror" id="req_no" name="req_no" value="{{ old('req_no') }}" placeholder="Auto-generated if left blank">
                        @error('req_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="requester_branch_id" class="form-label">Requesting Branch <span class="text-danger">*</span></label>
                        <select class="form-select @error('requester_branch_id') is-invalid @enderror" id="requester_branch_id" name="requester_branch_id" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('requester_branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        @error('requester_branch_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
                        <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                            <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                        @error('priority')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="requested_date" class="form-label">Requested Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('requested_date') is-invalid @enderror" id="requested_date" name="requested_date" value="{{ old('requested_date', date('Y-m-d')) }}" required>
                        @error('requested_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="required_by_date" class="form-label">Required By Date</label>
                        <input type="date" class="form-control @error('required_by_date') is-invalid @enderror" id="required_by_date" name="required_by_date" value="{{ old('required_by_date') }}">
                        @error('required_by_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="pending_bm" {{ old('status') == 'pending_bm' ? 'selected' : '' }}>Pending BM Approval</option>
                            <option value="pending_hr" {{ old('status') == 'pending_hr' ? 'selected' : '' }}>Pending HR Approval</option>
                            <option value="pending_cfo" {{ old('status') == 'pending_cfo' ? 'selected' : '' }}>Pending CFO Approval</option>
                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="fulfilled" {{ old('status') == 'fulfilled' ? 'selected' : '' }}>Fulfilled</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="purpose" class="form-label">Purpose</label>
                    <textarea class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" rows="2" placeholder="Enter the purpose of this requisition">{{ old('purpose') }}</textarea>
                    @error('purpose')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Save Requisition</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
