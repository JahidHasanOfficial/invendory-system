@extends('layouts.app')

@section('title', 'Asset Tracking')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Asset Tracking</h2>
        <a href="{{ route('admin.assets.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Assign Asset
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-barcode me-2"></i>All Assigned Assets</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Serial No</th>
                            <th>Product</th>
                            <th>Assigned To</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Condition</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                            <tr>
                                <td class="fw-bold">{{ $asset->serial_no }}</td>
                                <td>{{ $asset->product ? $asset->product->name : '-' }}</td>
                                <td>
                                    @if($asset->assignedTo)
                                        <i class="fas fa-user text-primary me-1"></i> {{ $asset->assignedTo->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($asset->lab)
                                        Lab: {{ $asset->lab->name }}
                                    @elseif($asset->branch)
                                        Branch: {{ $asset->branch->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ ucwords(str_replace('_', ' ', $asset->assignment_type)) }}</td>
                                <td>
                                    @if($asset->condition == 'good')
                                        <span class="badge bg-success">Good</span>
                                    @elseif($asset->condition == 'damaged')
                                        <span class="badge bg-danger">Damaged</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Under Repair</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $asset->status == 'assigned' ? 'info' : ($asset->status == 'returned' ? 'success' : 'secondary') }}">
                                        {{ ucfirst($asset->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.assets.edit', $asset->id) }}" class="btn btn-sm btn-info text-white shadow-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.assets.destroy', $asset->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger shadow-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No assets found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $assets->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
