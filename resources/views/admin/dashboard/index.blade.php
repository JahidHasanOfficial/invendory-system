@extends('layouts.app')

@section('page_title', 'ড্যাশবোর্ড')
@section('page_subtitle', 'ই-লায়েল ইনভেন্টরি কন্ট্রোল প্যানেল')

@section('content')
<div class="container-fluid p-4">
    <!-- welcome row -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg-white p-4 rounded-4 shadow-sm border border-light">
                <h4 class="mb-1 text-primary-dark">স্বাগতম, {{ auth()->user()->name ?? 'User' }}!</h4>
                <p class="text-muted mb-0">আজকের তারিখ: {{ now()->translatedFormat('d F, Y') }} | শেষ লগইন: {{ auth()->user()->last_login ? auth()->user()->last_login->format('h:i A') : 'N/A' }}</p>
            </div>
        </div>
    </div>
    
    <!-- statistics row -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card bg-white p-3 rounded-4 shadow-sm">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">মোট পণ্য</p>
                        <h2 class="mb-0">২৫০</h2>
                        <small class="text-success"><i class="fas fa-arrow-up"></i> +১২%</small>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                        <i class="fas fa-box fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-white p-3 rounded-4 shadow-sm">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">মোট স্টক মূল্য</p>
                        <h2 class="mb-0">৳ ৪২.৫লক্ষ</h2>
                        <small class="text-success"><i class="fas fa-arrow-up"></i> +৫.৭%</small>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-3">
                        <i class="fas fa-taka-sign fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-white p-3 rounded-4 shadow-sm">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">লো স্টক এলার্ট</p>
                        <h2 class="mb-0 text-warning">১২</h2>
                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> মনোযোগ দিন!</small>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3">
                        <i class="fas fa-bell fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-white p-3 rounded-4 shadow-sm">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">পেন্ডিং অনুমোদন</p>
                        <h2 class="mb-0">৩</h2>
                        <small class="text-info"><i class="fas fa-clock"></i> আপনার জন্য</small>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-3">
                        <i class="fas fa-clipboard-list fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- chart and transactions -->
    <div class="row g-4 mb-4">
        <div class="col-md-7">
            <div class="bg-white p-4 rounded-4 shadow-sm border border-light h-100">
                <h5>শাখাভিত্তিক স্টক</h5>
                <canvas id="stockChart" height="200"></canvas>
            </div>
        </div>
        <div class="col-md-5">
            <div class="bg-white p-4 rounded-4 shadow-sm border border-light h-100">
                <h5>সাম্প্রতিক লেনদেন</h5>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between border-0 px-0 py-2 border-bottom">
                        <span><i class="fas fa-exchange-alt text-info"></i> ট্রান্সফার</span>
                        <span>উত্তরা → গুলশান</span>
                        <span class="badge bg-success">সম্পূর্ণ</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between border-0 px-0 py-2 border-bottom">
                        <span><i class="fas fa-shopping-cart text-success"></i> ক্রয়</span>
                        <span>মাউস ২০ পিস</span>
                        <span class="badge bg-info">প্রাপ্ত</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between border-0 px-0 py-2 border-bottom">
                        <span><i class="fas fa-tools text-warning"></i> রিপেয়ার</span>
                        <span>কম্পিউটার</span>
                        <span class="badge bg-warning">চলছে</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.addEventListener('load', () => {
        const ctx = document.getElementById('stockChart')?.getContext('2d');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['উত্তরা', 'গুলশান', 'বনানী', 'মিরপুর', 'চট্টগ্রাম'],
                    datasets: [{
                        label: 'স্টক পরিমাণ',
                        data: [42, 38, 29, 25, 35],
                        backgroundColor: '#1E3A5F',
                        borderRadius: 8
                    }]
                }
            });
        }
    });
</script>
