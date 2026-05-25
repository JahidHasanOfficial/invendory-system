<div class="topbar d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-2">
        <button class="btn btn-light d-md-none p-1 border-0" id="topbarHamburger">
            <i class="fas fa-bars fs-5 text-primary"></i>
        </button>
        <div>
            <h5 class="mb-0 text-primary-dark">@yield('page_title', 'ড্যাশবোর্ড')</h5>
            <small class="text-muted" id="topbarSubtitle">@yield('page_subtitle', 'ই-লায়েল ইনভেন্টরি কন্ট্রোল প্যানেল')</small>
        </div>
    </div>
    <div class="d-flex align-items-center gap-3">
        <!-- নোটিফিকেশন বেল ড্রপডাউন -->
        <div class="dropdown">
            <button class="btn btn-light position-relative p-2 border-0 bg-transparent" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-bell fs-5 text-secondary"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 9px; padding: 3px 6px;">৩</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-0" style="width: 280px; font-size: 13.5px;">
                <li class="dropdown-header border-bottom p-3"><h6 class="mb-0 text-primary-dark">নোটিফিকেশন সমূহ</h6></li>
                <li class="p-3 border-bottom bg-light bg-opacity-25">
                    <div class="d-flex justify-content-between">
                        <strong>নতুন রিকুইজিশন</strong>
                        <small class="text-muted">১০ মি. আগে</small>
                    </div>
                    <p class="mb-0 text-muted mt-1" style="font-size: 12.5px;">উত্তরা শাখা থেকে মাউসের রিকুইজিশন এসেছে।</p>
                </li>
                <li class="p-3 border-bottom">
                    <div class="d-flex justify-content-between">
                        <strong class="text-warning-custom">লো স্টক এলার্ট</strong>
                        <small class="text-muted">১ ঘণ্টা আগে</small>
                    </div>
                    <p class="mb-0 text-muted mt-1" style="font-size: 12.5px;">HP টোনার কার্টিজের স্টক রি-অর্ডার লেভেলের নিচে।</p>
                </li>
                <li class="p-3 text-center bg-light border-top">
                    <a href="#" class="text-decoration-none text-primary" style="font-size: 12.5px;">সব নোটিফিকেশন দেখুন</a>
                </li>
            </ul>
        </div>
        <!-- প্রোফাইলDropdown -->
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2 border-0 bg-transparent" type="button" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=random" class="rounded-circle border" style="width: 32px; height: 32px; object-fit: cover;">
                <span class="d-none d-sm-inline font-semibold" style="font-size: 14px;">{{ auth()->user()->name ?? 'User' }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li><a class="dropdown-item py-2" href="{{ url('admin/profile') }}"><i class="fas fa-user me-2 text-muted"></i>প্রোফাইল</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('admin/settings') }}"><i class="fas fa-cog me-2 text-muted"></i>সেটিংস</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>লগআউট
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
