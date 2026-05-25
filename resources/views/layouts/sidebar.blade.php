<div class="sidebar" id="sidebar">
    <div class="p-3">
        <!-- লোগো সেকশন -->
        <div class="text-center mb-4 py-2" style="cursor: pointer;" onclick="location.href='{{ url('admin/dashboard') }}'">
            <i class="fas fa-chalkboard-user fs-1 text-white"></i>
            <h5 class="text-white mt-2 mb-0 font-bold">e-laeltd.com</h5>
            <small class="text-white-50">ইনভেন্টরি সিস্টেম</small>
        </div>
        
        <!-- প্রধান নেভিগেশন -->
        <nav class="nav flex-column">
            <!-- ১. ড্যাশবোর্ড -->
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ url('admin/dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> ড্যাশবোর্ড
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ২. পণ্য ও ইনভেন্টরি সেকশন -->
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">পণ্য ও ইনভেন্টরি</div>
            
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
                <i class="fas fa-ruler"></i> ইউনিট সমূহ
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ৩. শাখা ও ল্যাব সেকশন -->
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">শাখা ও ল্যাব</div>
            
            <a class="nav-link {{ request()->is('admin/branches*') ? 'active' : '' }}" href="{{ url('admin/branches') }}">
                <i class="fas fa-building"></i> শাখা সমূহ
            </a>
            <a class="nav-link {{ request()->is('admin/labs*') ? 'active' : '' }}" href="{{ url('admin/labs') }}">
                <i class="fas fa-laptop"></i> ল্যাব সমূহ
            </a>
            <a class="nav-link {{ request()->is('admin/workstations*') ? 'active' : '' }}" href="{{ url('admin/workstations') }}">
                <i class="fas fa-microchip"></i> ওয়ার্কস্টেশন
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ৪. স্টক ও অ্যাসেট সেকশন -->
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">স্টক ও অ্যাসেট</div>
            
            <a class="nav-link {{ request()->is('admin/stocks*') ? 'active' : '' }}" href="{{ url('admin/stocks') }}">
                <i class="fas fa-database"></i> বর্তমান স্টক
            </a>
            <a class="nav-link {{ request()->is('admin/assets*') ? 'active' : '' }}" href="{{ url('admin/assets') }}">
                <i class="fas fa-desktop"></i> অ্যাসেট ট্র্যাকিং
            </a>
            <a class="nav-link {{ request()->is('admin/employee-assets*') ? 'active' : '' }}" href="{{ url('admin/employee-assets') }}">
                <i class="fas fa-users"></i> এমপ্লয়ি অ্যাসেট
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ৫. লেনদেন সেকশন -->
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">লেনদেন ও অপারেশন</div>
            
            <a class="nav-link {{ request()->is('admin/requisitions*') ? 'active' : '' }}" href="{{ url('admin/requisitions') }}">
                <i class="fas fa-clipboard-list"></i> রিকুইজিশন
            </a>
            <a class="nav-link {{ request()->is('admin/transfers*') ? 'active' : '' }}" href="{{ url('admin/transfers') }}">
                <i class="fas fa-exchange-alt"></i> ট্রান্সফার
            </a>
            <a class="nav-link {{ request()->is('admin/repairs*') ? 'active' : '' }}" href="{{ url('admin/repairs') }}">
                <i class="fas fa-tools"></i> রিপেয়ার/সার্ভিস
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ৬. ক্রয় ও ভেন্ডার সেকশন -->
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">ক্রয় ও ভেন্ডার</div>
            
            <a class="nav-link" href="#">
                <i class="fas fa-shopping-cart"></i> ক্রয় অর্ডার (পিও)
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-truck-fast"></i> গুডস রিসিপ্ট
            </a>
            <a class="nav-link {{ request()->is('admin/vendors*') ? 'active' : '' }}" href="{{ url('admin/vendors') }}">
                <i class="fas fa-handshake"></i> ভেন্ডার তালিকা
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ৭. রিপোর্ট ও অ্যাডমিন সেকশন -->
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">রিপোর্ট ও অ্যাডমিন</div>
            
            <a class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}" href="{{ url('admin/reports') }}">
                <i class="fas fa-chart-pie"></i> ইনভেন্টরি রিপোর্ট
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-history"></i> স্টক মুভমেন্ট
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-bell"></i> নোটিফিকেশন <span class="badge bg-danger rounded-pill ms-auto">3</span>
            </a>
            
            <hr class="bg-white-50 my-2 opacity-20">
            
            <!-- ৮. সিস্টেম সেকশন -->
            <div class="text-white-50 small px-3 py-1 fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">সিস্টেম</div>
            
            <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ url('admin/users') }}">
                <i class="fas fa-users-gear"></i> ব্যবহারকারী
            </a>
            <a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="{{ url('admin/settings') }}">
                <i class="fas fa-cog"></i> সেটিংস
            </a>
            
            <hr class="bg-white-50 my-3 opacity-20">
            
            <!-- ৯. প্রোফাইল সেকশন -->
            <a class="nav-link {{ request()->is('admin/profile*') ? 'active' : '' }}" href="{{ url('admin/profile') }}">
                <i class="fas fa-user-circle"></i> প্রোফাইল
            </a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
                @csrf
                <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i> লগআউট
                </a>
            </form>
        </nav>
    </div>
</div>
