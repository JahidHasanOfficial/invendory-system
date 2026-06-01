@extends('layouts.app')

@section('title', 'Employee Assets')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Employee Assets</h2>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users-cog me-2"></i>Assets Assigned to Employees</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Employee</th>
                            <th>Serial No</th>
                            <th>Product</th>
                            <th>Branch</th>
                            <th>Condition</th>
                            <th>Status</th>
                            <th>Assigned Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employeeAssets as $asset)
                            <tr>
                                <td class="fw-bold text-primary">
                                    <i class="fas fa-user-circle me-1"></i> {{ $asset->assignedTo ? $asset->assignedTo->name : 'Unknown' }}
                                </td>
                                <td class="fw-bold">{{ $asset->serial_no }}</td>
                                <td>{{ $asset->product ? $asset->product->name : '-' }}</td>
                                <td>{{ $asset->branch ? $asset->branch->name : '-' }}</td>
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
                                <td>{{ \Carbon\Carbon::parse($asset->assigned_date)->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No assets assigned to employees.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $employeeAssets->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
