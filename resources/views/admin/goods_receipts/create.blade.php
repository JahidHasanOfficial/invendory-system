@extends('layouts.app')

@section('title', 'Create Goods Receipt')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Create Goods Receipt</h2>
        <a href="{{ route('admin.goods-receipts.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Goods Receipt Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.goods-receipts.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="gr_no" class="form-label">GR Number</label>
                        <input type="text" class="form-control @error('gr_no') is-invalid @enderror" id="gr_no" name="gr_no" value="{{ old('gr_no') }}" placeholder="Auto-generated if left blank">
                        @error('gr_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="po_id" class="form-label">Purchase Order <span class="text-danger">*</span></label>
                        <select class="form-select @error('po_id') is-invalid @enderror" id="po_id" name="po_id" required>
                            <option value="">Select PO</option>
                            @foreach($purchaseOrders as $po)
                                <option value="{{ $po->id }}" {{ old('po_id') == $po->id ? 'selected' : '' }}>{{ $po->po_no }}</option>
                            @endforeach
                        </select>
                        @error('po_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="branch_id" class="form-label">Receiving Branch <span class="text-danger">*</span></label>
                        <select class="form-select @error('branch_id') is-invalid @enderror" id="branch_id" name="branch_id" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        @error('branch_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="received_date" class="form-label">Received Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('received_date') is-invalid @enderror" id="received_date" name="received_date" value="{{ old('received_date', date('Y-m-d')) }}" required>
                        @error('received_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2" placeholder="Enter any notes">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Save Goods Receipt</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
