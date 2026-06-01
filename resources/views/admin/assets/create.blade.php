@extends('layouts.app')

@section('title', 'Assign Asset')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Assign Asset</h2>
        <a href="{{ route('admin.assets.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Assignment Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.assets.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="product_id" class="form-label">Product <span class="text-danger">*</span></label>
                        <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="serial_no" class="form-label">Serial Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('serial_no') is-invalid @enderror" id="serial_no" name="serial_no" value="{{ old('serial_no') }}" placeholder="Enter serial number" required>
                        @error('serial_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="branch_id" class="form-label">Branch <span class="text-danger">*</span></label>
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
                    <div class="col-md-4">
                        <label for="lab_id" class="form-label">Lab (Optional)</label>
                        <select class="form-select @error('lab_id') is-invalid @enderror" id="lab_id" name="lab_id">
                            <option value="">None</option>
                            @foreach($labs as $lab)
                                <option value="{{ $lab->id }}" {{ old('lab_id') == $lab->id ? 'selected' : '' }}>{{ $lab->name }}</option>
                            @endforeach
                        </select>
                        @error('lab_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="assigned_to_user_id" class="form-label">Assign To User (Optional)</label>
                        <select class="form-select @error('assigned_to_user_id') is-invalid @enderror" id="assigned_to_user_id" name="assigned_to_user_id">
                            <option value="">None</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('assigned_to_user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('assigned_to_user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="assignment_type" class="form-label">Assignment Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('assignment_type') is-invalid @enderror" id="assignment_type" name="assignment_type" required>
                            <option value="permanent" {{ old('assignment_type') == 'permanent' ? 'selected' : '' }}>Permanent</option>
                            <option value="temporary" {{ old('assignment_type') == 'temporary' ? 'selected' : '' }}>Temporary</option>
                            <option value="lab_assigned" {{ old('assignment_type') == 'lab_assigned' ? 'selected' : '' }}>Lab Assigned</option>
                        </select>
                        @error('assignment_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="assigned_date" class="form-label">Assigned Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('assigned_date') is-invalid @enderror" id="assigned_date" name="assigned_date" value="{{ old('assigned_date', date('Y-m-d')) }}" required>
                        @error('assigned_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="condition" class="form-label">Condition <span class="text-danger">*</span></label>
                        <select class="form-select @error('condition') is-invalid @enderror" id="condition" name="condition" required>
                            <option value="good" {{ old('condition') == 'good' ? 'selected' : '' }}>Good</option>
                            <option value="damaged" {{ old('condition') == 'damaged' ? 'selected' : '' }}>Damaged</option>
                            <option value="under_repair" {{ old('condition') == 'under_repair' ? 'selected' : '' }}>Under Repair</option>
                        </select>
                        @error('condition')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="assigned" {{ old('status') == 'assigned' ? 'selected' : '' }}>Assigned</option>
                            <option value="returned" {{ old('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                            <option value="lost" {{ old('status') == 'lost' ? 'selected' : '' }}>Lost</option>
                            <option value="disposed" {{ old('status') == 'disposed' ? 'selected' : '' }}>Disposed</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2" placeholder="Enter notes">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Save Assignment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
