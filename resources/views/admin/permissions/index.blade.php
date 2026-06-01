@extends('layouts.app')

@section('title', 'Permissions')

@section('content')
<div class="container-fluid px-4 py-4">
    
    <div class="bg-white rounded-4 shadow-sm border border-light p-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 text-gray-800 fw-bold">Permissions</h4>
            <div class="position-relative">
                <input type="text" class="form-control rounded-pill ps-4 bg-light border-0" placeholder="Search..." style="width: 250px;">
                <i class="fas fa-search position-absolute text-muted" style="top: 10px; right: 15px;"></i>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle border-bottom">
                <thead class="text-muted" style="font-size: 0.9rem;">
                    <tr>
                        <th width="5%" class="fw-semibold">Sl</th>
                        <th width="25%" class="fw-semibold">Permission Name</th>
                        <th width="35%" class="fw-semibold">Roles</th>
                        <th width="15%" class="fw-semibold text-center">Created Date</th>
                        <th width="15%" class="fw-semibold text-center">Updated Date</th>
                        <th width="5%" class="fw-semibold text-center">Roles Count</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($permissions as $index => $permission)
                    <tr>
                        <td class="text-muted">{{ $index + 1 }}</td>
                        <td class="fw-medium text-dark">{{ $permission->name }}</td>
                        <td>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($permission->roles as $role)
                                    <span class="badge rounded-pill bg-success fw-normal px-3 py-1">{{ $role->name }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="text-center text-muted" style="font-size: 0.85rem;">
                            {{ $permission->created_at ? $permission->created_at->format('Y-m-d h:i:s A') : '-' }}
                        </td>
                        <td class="text-center text-muted" style="font-size: 0.85rem;">
                            {{ $permission->updated_at ? $permission->updated_at->format('Y-m-d h:i:s A') : '-' }}
                        </td>
                        <td class="text-center">
                            <span class="border rounded-circle d-inline-flex align-items-center justify-content-center text-muted" style="width: 28px; height: 28px; font-size: 0.85rem;">
                                {{ $permission->roles->count() }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
