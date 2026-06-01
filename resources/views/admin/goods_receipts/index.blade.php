@extends('layouts.app')

@section('title', 'Goods Receipts')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Goods Receipts</h2>
        <a href="{{ route('admin.goods-receipts.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Create Goods Receipt
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
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-truck-loading me-2"></i>Goods Receipt List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>GR No</th>
                            <th>PO No</th>
                            <th>Branch</th>
                            <th>Received By</th>
                            <th>Received Date</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($goodsReceipts as $gr)
                            <tr>
                                <td class="fw-bold">{{ $gr->gr_no }}</td>
                                <td>{{ $gr->purchaseOrder ? $gr->purchaseOrder->po_no : '-' }}</td>
                                <td>{{ $gr->branch ? $gr->branch->name : '-' }}</td>
                                <td>{{ $gr->receivedBy ? $gr->receivedBy->name : '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($gr->received_date)->format('d M, Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $gr->status == 'pending' ? 'warning text-dark' : 'success' }}">
                                        {{ ucfirst($gr->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.goods-receipts.edit', $gr->id) }}" class="btn btn-sm btn-info text-white shadow-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.goods-receipts.destroy', $gr->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this Goods Receipt?');">
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
                                <td colspan="7" class="text-center py-4 text-muted">No goods receipts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $goodsReceipts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
