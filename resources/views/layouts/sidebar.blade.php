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
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Products & Inventory</div>
            
            <a class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}" href="{{ url('admin/products') }}">
                <i class="fas fa-boxes"></i> পণ্য তালিকা
            </a>
            <a class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}" href="{{ url('admin/categories') }}">
                <i class="fas fa-tags"></i> পণ্যের ক্যাটাগরি
            </a>
            <a class="nav-link {{ request()->is('admin/brands*') ? 'active' : '' }}" href="{{ url('admin/brands') }}">
                <i class="fas fa-trademark"></i> ব্র্যান্ড সমূহ
            </a>
            <a class="nav-link {{ request()->is('admin/units*') ? 'active' : '' }}" href="{{ url('admin/units') }}">
                <i class="fas fa-ruler"></i> Units
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ৩. শাখা ও ল্যাব সেকশন -->
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Branches & Labs</div>
            
            <a class="nav-link {{ request()->is('admin/branches*') ? 'active' : '' }}" href="{{ url('admin/branches') }}">
                <i class="fas fa-building"></i> Branches
            </a>
            <a class="nav-link {{ request()->is('admin/labs*') ? 'active' : '' }}" href="{{ url('admin/labs') }}">
                <i class="fas fa-laptop"></i> Labs
            </a>
            <a class="nav-link {{ request()->is('admin/workstations*') ? 'active' : '' }}" href="{{ url('admin/workstations') }}">
                <i class="fas fa-microchip"></i> Workstations
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ৪. স্টক ও অ্যাসেট সেকশন -->
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Stock & Asset</div>
            
            <a class="nav-link {{ request()->is('admin/stocks*') ? 'active' : '' }}" href="{{ url('admin/stocks') }}">
                <i class="fas fa-database"></i> Current Stock
            </a>
            <a class="nav-link {{ request()->is('admin/assets*') ? 'active' : '' }}" href="{{ url('admin/assets') }}">
                <i class="fas fa-desktop"></i> Asset Tracking
            </a>
            <a class="nav-link {{ request()->is('admin/employee-assets*') ? 'active' : '' }}" href="{{ url('admin/employee-assets') }}">
                <i class="fas fa-users"></i> Employee Asset
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ৫. লেনদেন সেকশন -->
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Transactions & Operations</div>
            
            <a class="nav-link {{ request()->is('admin/requisitions*') ? 'active' : '' }}" href="{{ url('admin/requisitions') }}">
                <i class="fas fa-clipboard-list"></i> Requisition
            </a>
            <a class="nav-link {{ request()->is('admin/transfers*') ? 'active' : '' }}" href="{{ url('admin/transfers') }}">
                <i class="fas fa-exchange-alt"></i> Transfer
            </a>
            <a class="nav-link {{ request()->is('admin/repairs*') ? 'active' : '' }}" href="{{ url('admin/repairs') }}">
                <i class="fas fa-tools"></i> Repair/Service
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ৬. ক্রয় ও ভেন্ডার সেকশন -->
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Purchase & Vendor</div>
            
            <a class="nav-link" href="#">
                <i class="fas fa-shopping-cart"></i> Purchase Order (PO)
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-truck-fast"></i> Goods Receipt
            </a>
            <a class="nav-link {{ request()->is('admin/vendors*') ? 'active' : '' }}" href="{{ url('admin/vendors') }}">
                <i class="fas fa-handshake"></i> Vendor List
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ৭. রিপোর্ট ও অ্যাডমিন সেকশন -->
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Reports & Admin</div>
            
            <a class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}" href="{{ url('admin/reports') }}">
                <i class="fas fa-chart-pie"></i> Inventory Report
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-history"></i> Stock Movement
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-bell"></i> Notifications <span class="badge bg-danger rounded-pill ms-auto">3</span>
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ৮. সিস্টেম সেকশন -->
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">System</div>
            
            <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ url('admin/users') }}">
                <i class="fas fa-users-gear"></i> Users
            </a>
            
            <!-- Role & Permission Menu -->
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
                        <a class="nav-link py-2 {{ request()->routeIs('admin.roles.index') ? 'active text-white bg-white bg-opacity-10 rounded' : 'text-white-50' }}" href="{{ route('admin.roles.index') }}">
                            Roles List
                        </a>
                        <a class="nav-link py-2 {{ request()->routeIs('admin.permissions.index') ? 'active text-white bg-white bg-opacity-10 rounded' : 'text-white-50' }}" href="{{ route('admin.permissions.index') }}">
                            Permissions List
                        </a>
                    </div>
                </div>
            </div>

            <a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="{{ url('admin/settings') }}">
                <i class="fas fa-cog"></i> সেটিংস
            </a>
            
            <hr class="bg-white-50 my-3 opacity-20">
            
            <!-- ৯. প্রোফাইল সেকশন -->
            <a class="nav-link {{ request()->is('admin/profile*') ? 'active' : '' }}" href="{{ url('admin/profile') }}">
                <i class="fas fa-user-circle"></i> Profile
            </a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
                @csrf
                <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </nav>
    </div>
</div>
