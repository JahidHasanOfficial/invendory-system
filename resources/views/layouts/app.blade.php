<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ড্যাশবোর্ড') | e-laeltd.com</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Custom Style Sheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('css')
</head>
<body>

<!-- মোবাইল ভিউ টগল বাটন -->
<button class="hamburger-btn position-fixed bottom-0 end-0 m-3 shadow" id="sidebarToggle" style="z-index: 1060;">
    <i class="fas fa-bars"></i>
</button>

<div class="container-fluid px-0">
    
    @include('layouts.sidebar')
    
    <!-- মেইন কন্টেন্ট এরিয়া -->
    <div class="main-content" id="mainContent">
        
        @include('layouts.topbar')
        
        <!-- পেজ ভিউ কন্টেন্ট -->
        <div class="flex-grow-1">
            @yield('content')
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // মোবাইল স্ক্রিনে সাইডবার শো/হাইড স্ক্রিপ্ট
    const toggleBtn = document.getElementById('sidebarToggle');
    const topbarHamburger = document.getElementById('topbarHamburger');
    const sidebar = document.getElementById('sidebar');
    
    if ((toggleBtn || topbarHamburger) && sidebar) {
        // ক্রিয়েট ওভারলে
        const overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        document.body.appendChild(overlay);

        const toggleSidebar = () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        };

        if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
        if (topbarHamburger) topbarHamburger.addEventListener('click', toggleSidebar);
        
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    }
</script>
@stack('scripts')
</body>
</html>
