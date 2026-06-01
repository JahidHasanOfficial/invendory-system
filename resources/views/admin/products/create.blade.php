@extends('layouts.app')

@section('page_title', 'Add Product')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Add Product</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <div class="card shadow mb-4 border-0">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-primary">Basic Information</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="brand_id" class="form-label">Brand</label>
                        <select class="form-select @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id">
                            <option value="">-- Select Brand --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="unit_id" class="form-label">Unit</label>
                        <select class="form-select @error('unit_id') is-invalid @enderror" id="unit_id" name="unit_id">
                            <option value="">-- Select Unit --</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->full_name }} ({{ $unit->short_name }})</option>
                            @endforeach
                        </select>
                        @error('unit_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="purchase_price" class="form-label">Purchase Price</label>
                        <input type="number" step="0.01" class="form-control @error('purchase_price') is-invalid @enderror" id="purchase_price" name="purchase_price" value="{{ old('purchase_price', 0) }}">
                        @error('purchase_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" value="{{ old('sku') }}">
                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="barcode" class="form-label">Barcode</label>
                        <input type="text" class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" value="{{ old('barcode') }}">
                        @error('barcode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="short_description" class="form-label">Short Description</label>
                        <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="2">{{ old('short_description') }}</textarea>
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4 border-0">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-primary">Inventory & Tracking</h6>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_batch_tracked" name="is_batch_tracked" value="1" {{ old('is_batch_tracked') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_batch_tracked">Batch Tracked</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_serial_tracked" name="is_serial_tracked" value="1" {{ old('is_serial_tracked') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_serial_tracked">Serial Tracked</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_asset" name="is_asset" value="1" {{ old('is_asset') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_asset">Is Asset</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Save Product</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
