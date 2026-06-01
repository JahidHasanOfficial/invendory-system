@extends('layouts.app')

@section('title', 'Add Unit')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Add Unit</h2>
        <a href="{{ route('admin.units.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Unit Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.units.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                        @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="short_name" class="form-label">Short Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('short_name') is-invalid @enderror" id="short_name" name="short_name" value="{{ old('short_name') }}" required>
                        @error('short_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Save Unit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
