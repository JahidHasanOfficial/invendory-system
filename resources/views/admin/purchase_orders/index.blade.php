@extends('layouts.app')

@section('title', 'Purchase Orders')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Purchase Orders</h2>
        <a href="{{ route('admin.purchase-orders.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Create PO
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
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-shopping-cart me-2"></i>Purchase Order List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>PO No</th>
                            <th>Vendor</th>
                            <th>Branch</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($purchaseOrders as $po)
                            <tr>
                                <td class="fw-bold">{{ $po->po_no }}</td>
                                <td>{{ $po->vendor ? $po->vendor->name : '-' }}</td>
                                <td>{{ $po->branch ? $po->branch->name : '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($po->order_date)->format('d M, Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $po->status == 'draft' ? 'secondary' : ($po->status == 'approved' ? 'success' : 'info') }}">
                                        {{ ucfirst($po->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.purchase-orders.edit', $po->id) }}" class="btn btn-sm btn-info text-white shadow-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.purchase-orders.destroy', $po->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this PO?');">
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
                                <td colspan="6" class="text-center py-4 text-muted">No purchase orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $purchaseOrders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
