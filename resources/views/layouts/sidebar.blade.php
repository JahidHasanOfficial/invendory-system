<div class="sidebar" id="sidebar">
    <div class="p-3">
        <!-- লোগো সেকশন -->
        <div class="text-center mb-4 py-2" style="cursor: pointer;" onclick="location.href='{{ url('admin/dashboard') }}'">
            <i class="fas fa-chalkboard-user fs-1 text-white"></i>
            <h5 class="text-white mt-2 mb-0 font-bold">e-laeltd.com</h5>
            <small class="text-white-50">Inventory System</small>
        </div>
        
        <!-- প্রধান নেভিগেশন -->
        <nav class="nav flex-column">
            <!-- ১. ড্যাশবোর্ড -->
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ url('admin/dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> ড্যাশবোর্ড
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ২. পণ্য ও ইনভেন্টরি সেকশন -->
            @canany(['products.view', 'categories.view', 'brands.view', 'units.view'])
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Products & Inventory</div>
            
            @can('products.view')
            <a class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}" href="{{ url('admin/products') }}">
                <i class="fas fa-boxes"></i> পণ্য তালিকা
            </a>
            @endcan
            @can('categories.view')
            <a class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}" href="{{ url('admin/categories') }}">
                <i class="fas fa-tags"></i> পণ্যের ক্যাটাগরি
            </a>
            @endcan
            @can('brands.view')
            <a class="nav-link {{ request()->is('admin/brands*') ? 'active' : '' }}" href="{{ url('admin/brands') }}">
                <i class="fas fa-trademark"></i> ব্র্যান্ড সমূহ
            </a>
            @endcan
            @can('units.view')
            <a class="nav-link {{ request()->is('admin/units*') ? 'active' : '' }}" href="{{ url('admin/units') }}">
                <i class="fas fa-ruler"></i> Units
            </a>
            @endcan
            
            <hr class="bg-white-50 my-2 opacity-20">
            @endcanany
            
            <!-- ৩. শাখা ও ল্যাব সেকশন -->
            @canany(['branches.view', 'labs.view', 'workstations.view'])
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Branches & Labs</div>
            
            @can('branches.view')
            <a class="nav-link {{ request()->is('admin/branches*') ? 'active' : '' }}" href="{{ url('admin/branches') }}">
                <i class="fas fa-building"></i> Branches
            </a>
            @endcan
            @can('labs.view')
            <a class="nav-link {{ request()->is('admin/labs*') ? 'active' : '' }}" href="{{ url('admin/labs') }}">
                <i class="fas fa-laptop"></i> Labs
            </a>
            @endcan
            @can('workstations.view')
            <a class="nav-link {{ request()->is('admin/workstations*') ? 'active' : '' }}" href="{{ url('admin/workstations') }}">
                <i class="fas fa-microchip"></i> Workstations
            </a>
            @endcan
            
            <hr class="bg-white-50 my-2 opacity-20">
            @endcanany
            
            <!-- ৪. স্টক ও অ্যাসেট সেকশন -->
            @canany(['stocks.view', 'assets.view', 'employee-assets.view'])
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Stock & Asset</div>
            
            @can('stocks.view')
            <a class="nav-link {{ request()->is('admin/stocks*') ? 'active' : '' }}" href="{{ url('admin/stocks') }}">
                <i class="fas fa-database"></i> Current Stock
            </a>
            @endcan
            @can('assets.view')
            <a class="nav-link {{ request()->is('admin/assets*') ? 'active' : '' }}" href="{{ url('admin/assets') }}">
                <i class="fas fa-desktop"></i> Asset Tracking
            </a>
            @endcan
            @can('employee-assets.view')
            <a class="nav-link {{ request()->is('admin/employee-assets*') ? 'active' : '' }}" href="{{ url('admin/employee-assets') }}">
                <i class="fas fa-users"></i> Employee Asset
            </a>
            @endcan
            
            <hr class="bg-white-50 my-2 opacity-20">
            @endcanany
            
            <!-- ৫. লেনদেন সেকশন -->
            @canany(['requisitions.view', 'transfers.view', 'repairs.view'])
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Transactions & Operations</div>
            
            @can('requisitions.view')
            <a class="nav-link {{ request()->is('admin/requisitions*') ? 'active' : '' }}" href="{{ url('admin/requisitions') }}">
                <i class="fas fa-clipboard-list"></i> Requisition
            </a>
            @endcan
            @can('transfers.view')
            <a class="nav-link {{ request()->is('admin/transfers*') ? 'active' : '' }}" href="{{ url('admin/transfers') }}">
                <i class="fas fa-exchange-alt"></i> Transfer
            </a>
            @endcan
            @can('repairs.view')
            <a class="nav-link {{ request()->is('admin/repairs*') ? 'active' : '' }}" href="{{ url('admin/repairs') }}">
                <i class="fas fa-tools"></i> Repair/Service
            </a>
            @endcan
            
            <hr class="bg-white-50 my-2 opacity-20">
            @endcanany
            
            <!-- ৬. ক্রয় ও ভেন্ডার সেকশন -->
            @canany(['purchase-orders.view', 'goods-receipts.view', 'vendors.view'])
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Purchase & Vendor</div>
            
            @can('purchase-orders.view')
            <a class="nav-link {{ request()->is('admin/purchase-orders*') ? 'active' : '' }}" href="{{ url('admin/purchase-orders') }}">
                <i class="fas fa-shopping-cart"></i> Purchase Order (PO)
            </a>
            @endcan
            @can('goods-receipts.view')
            <a class="nav-link {{ request()->is('admin/goods-receipts*') ? 'active' : '' }}" href="{{ url('admin/goods-receipts') }}">
                <i class="fas fa-truck-fast"></i> Goods Receipt
            </a>
            @endcan
            @can('vendors.view')
            <a class="nav-link {{ request()->is('admin/vendors*') ? 'active' : '' }}" href="{{ url('admin/vendors') }}">
                <i class="fas fa-handshake"></i> Vendor List
            </a>
            @endcan
            
            <hr class="bg-white-50 my-2 opacity-20">
            @endcanany
            
            <!-- ৭. রিপোর্ট ও অ্যাডমিন সেকশন -->
            @canany(['reports.view', 'stock-movements.view', 'notifications.view'])
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Reports & Admin</div>
            
            @can('reports.view')
            <a class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}" href="{{ url('admin/reports') }}">
                <i class="fas fa-chart-pie"></i> Inventory Report
            </a>
            @endcan
            @can('stock-movements.view')
            <a class="nav-link {{ request()->is('admin/stock-movements*') ? 'active' : '' }}" href="{{ url('admin/stock-movements') }}">
                <i class="fas fa-history"></i> Stock Movement
            </a>
            @endcan
            @can('notifications.view')
            <a class="nav-link" href="#">
                <i class="fas fa-bell"></i> Notifications <span class="badge bg-danger rounded-pill ms-auto">3</span>
            </a>
            @endcan
            
            <hr class="bg-white-50 my-2 opacity-20">
            @endcanany
            
            <!-- ৮. সিস্টেম সেকশন -->
            @canany(['users.view', 'roles.view', 'permissions.view', 'settings.view'])
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">System</div>
            
            @can('users.view')
            <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ url('admin/users') }}">
                <i class="fas fa-users-gear"></i> Users
            </a>
            @endcan
            
            <!-- Role & Permission Menu -->
            @canany(['roles.view', 'permissions.view'])
            <div class="nav-item">
                <a class="nav-link {{ request()->is('admin/roles*') || request()->is('admin/permissions*') ? 'active' : 'text-white-50' }}" 
                   data-bs-toggle="collapse" 
                   href="#rolePermissionCollapse" 
                   role="button" 
                   aria-expanded="{{ request()->is('admin/roles*') || request()->is('admin/permissions*') ? 'true' : 'false' }}" 
                   aria-controls="rolePermissionCollapse"
                   style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <i class="fas fa-shield-alt text-success me-2"></i> Role & Permission
                    </div>
                    <i class="fas fa-chevron-down ms-auto" style="font-size: 10px; transition: transform 0.3s;" id="rp-chevron"></i>
                </a>
                <div class="collapse {{ request()->is('admin/roles*') || request()->is('admin/permissions*') ? 'show' : '' }}" id="rolePermissionCollapse">
                    <div class="nav flex-column ms-3 ps-3 border-start border-secondary" style="border-left-color: rgba(255,255,255,0.1) !important;">
                        @can('roles.view')
                        <a class="nav-link py-2 {{ request()->routeIs('admin.roles.index') ? 'active text-white bg-white bg-opacity-10 rounded' : 'text-white-50' }}" href="{{ route('admin.roles.index') }}">
                            Roles List
                        </a>
                        @endcan
                        @can('permissions.view')
                        <a class="nav-link py-2 {{ request()->routeIs('admin.permissions.index') ? 'active text-white bg-white bg-opacity-10 rounded' : 'text-white-50' }}" href="{{ route('admin.permissions.index') }}">
                            Permissions List
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
            @endcanany

            @can('settings.view')
            <a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="{{ url('admin/settings') }}">
                <i class="fas fa-cog"></i> সেটিংস
            </a>
            @endcan
            
            <hr class="bg-white-50 my-3 opacity-20">
            @endcanany
            
            <!-- ৯. প্রোফাইল সেকশন -->
             @can('profile.view')
            <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                <i class="fas fa-user-circle"></i> Profile
            </a>
            @endcan
            <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
                @csrf
                <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </nav>
    </div>
</div>
