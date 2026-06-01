@extends('layouts.app')

@section('title', 'Role & Permission')

@section('content')
<div class="container-fluid px-4 py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 text-gray-800 fw-bold">Roles</h4>
        <button class="btn btn-success shadow-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addRoleModal">
            Assign Role
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @foreach($roles as $role)
        <div class="col-12 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm border-0 rounded-4 text-center py-4">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="fw-bold mb-3">{{ $role->name }}</h5>
                    <button class="btn btn-outline-secondary btn-sm px-4 rounded-pill" 
                            onclick="openEditModal({{ $role->id }}, '{{ $role->name }}', {{ json_encode($role->permissions->pluck('id')) }})">
                        Edit Role
                    </button>
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-12 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm border-1 border-dashed border-primary rounded-4 text-center py-4" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                <div class="card-body d-flex flex-row justify-content-center align-items-center gap-2">
                    <div class="bg-light rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="fas fa-plus text-primary"></i>
                    </div>
                    <h6 class="fw-bold mb-0">Add New Role</h6>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="addRoleModalLabel">Add New Role</h5>
                <button type="button" class="btn-close btn-sm bg-danger text-white rounded-circle p-2" style="opacity: 1;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text" class="form-control rounded-3" id="name" name="name" required placeholder="e.g. manager">
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-danger px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success px-4 rounded-pill">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-bottom pb-3">
                <h5 class="modal-title fw-bold" id="editRoleModalLabel">Edit Role</h5>
                <button type="button" class="btn-close btn-sm bg-danger text-white rounded-circle p-2" style="opacity: 1; filter: invert(0);" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="editRoleForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4 bg-light">
                    
                    <div class="d-flex justify-content-between mb-4 px-3">
                        <div class="fw-bold text-muted">Edit Role Name</div>
                        <div class="fw-bold text-muted">Role Wise User Permissions</div>
                    </div>

                    <div class="mb-4 px-3">
                        <input type="text" class="form-control rounded-3" id="edit_role_name" name="name" required>
                    </div>

                    <div class="bg-white rounded-4 p-4 shadow-sm">
                        @foreach($groupedPermissions as $module => $permissions)
                            <div class="row align-items-start py-3 border-bottom module-group">
                                <div class="col-md-3 fw-bold">{{ $module }}</div>
                                <div class="col-md-9">
                                    <div class="d-flex flex-wrap gap-4">
                                        <!-- Select All for this module -->
                                        <div class="form-check custom-checkbox">
                                            <input class="form-check-input select-all-module rounded-1 bg-success border-success" type="checkbox" id="module_all_{{ Str::slug($module) }}">
                                            <label class="form-check-label fw-bold text-success" for="module_all_{{ Str::slug($module) }}">
                                                All
                                            </label>
                                        </div>
                                        
                                        @foreach($permissions as $permission)
                                            <div class="form-check custom-checkbox">
                                                <input class="form-check-input permission-checkbox rounded-1 bg-success border-success" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}">
                                                <label class="form-check-label" for="perm_{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="modal-footer border-top-0 pt-0 bg-light pb-4 pe-4">
                    <button type="button" class="btn btn-danger px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success px-4 rounded-pill">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .custom-checkbox .form-check-input:checked {
        background-color: #198754;
        border-color: #198754;
    }
    .custom-checkbox .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }
    .modal-xl {
        max-width: 1140px;
    }
</style>
@endpush

@push('scripts')
<script>
    function openEditModal(roleId, roleName, permissions) {
        document.getElementById('edit_role_name').value = roleName;
        document.getElementById('editRoleForm').action = '/admin/roles/' + roleId;
        
        // Reset all checkboxes
        document.querySelectorAll('.permission-checkbox').forEach(cb => cb.checked = false);
        
        // Check assigned permissions
        permissions.forEach(id => {
            const cb = document.getElementById('perm_' + id);
            if (cb) cb.checked = true;
        });

        // Update "Select All" states
        document.querySelectorAll('.module-group').forEach(group => {
            updateSelectAllState(group);
        });

        var editModal = new bootstrap.Modal(document.getElementById('editRoleModal'));
        editModal.show();
    }

    // Handle "Select All" for each module
    document.querySelectorAll('.select-all-module').forEach(selectAllCb => {
        selectAllCb.addEventListener('change', function() {
            const group = this.closest('.module-group');
            const checkboxes = group.querySelectorAll('.permission-checkbox');
            checkboxes.forEach(cb => {
                cb.checked = this.checked;
            });
        });
    });

    // Update "Select All" when individual checkboxes change
    document.querySelectorAll('.permission-checkbox').forEach(cb => {
        cb.addEventListener('change', function() {
            const group = this.closest('.module-group');
            updateSelectAllState(group);
        });
    });

    function updateSelectAllState(group) {
        const checkboxes = group.querySelectorAll('.permission-checkbox');
        const selectAllCb = group.querySelector('.select-all-module');
        
        const allChecked = Array.from(checkboxes).every(cb => cb.checked);
        const someChecked = Array.from(checkboxes).some(cb => cb.checked);
        
        selectAllCb.checked = allChecked;
        selectAllCb.indeterminate = someChecked && !allChecked;
    }
</script>
@endpush
@endsection
