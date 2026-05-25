@extends('layouts.app')

@section('page_title', 'ইনভেন্টরি রিপোর্ট')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>ইনভেন্টরি রিপোর্ট</h4>
            <button class="btn btn-outline-primary" onclick="alert('ইনভেন্টরি রিপোর্ট পিডিএফ ডাউনলোড হচ্ছে...')"><i class="fas fa-file-pdf me-2"></i>রিপোর্ট ডাউনলোড করুন</button>
        </div>
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 shadow-sm border border-light text-center">
                    <span class="text-muted d-block">সর্বমোট স্টককৃত পণ্য</span>
                    <h3 class="mt-2 mb-0">৫৬ টি</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 shadow-sm border border-light text-center">
                    <span class="text-muted d-block">মোট মেরামত ব্যয়</span>
                    <h3 class="mt-2 mb-0 text-danger">৳ ২,৫০০</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-4 shadow-sm border border-light text-center">
                    <span class="text-muted d-block">ট্রানজিটে আছে</span>
                    <h3 class="mt-2 mb-0 text-info">১ টি চালান</h3>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="bg-white p-4 rounded-4 shadow-sm border border-light h-100">
                    <h6 class="mb-4 text-primary-dark">পণ্য ক্যাটাগরি বিশ্লেষণ</h6>
                    <div style="position: relative; height: 260px;"><canvas id="categoryPieChart"></canvas></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-white p-4 rounded-4 shadow-sm border border-light h-100">
                    <h6 class="mb-4 text-primary-dark">মেরামত ব্যয় তুলনামূলক হিসেব</h6>
                    <div style="position: relative; height: 260px;"><canvas id="repairBarChart"></canvas></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.addEventListener('load', () => {
            const catCtx = document.getElementById('categoryPieChart')?.getContext('2d');
            if (catCtx) {
                new Chart(catCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['কম্পিউটার', 'পেরিফেরালস', 'স্টেশনারি'],
                        datasets: [{ data: [15, 53, 5], backgroundColor: ['#1E3A5F', '#2E8B57', '#FF6B35'] }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });
            }
            const repCtx = document.getElementById('repairBarChart')?.getContext('2d');
            if (repCtx) {
                new Chart(repCtx, {
                    type: 'bar',
                    data: {
                        labels: ['উত্তরা', 'গুলশান', 'চট্টগ্রাম'],
                        datasets: [{ label: 'ব্যয়', data: [200, 1500, 800], backgroundColor: '#FF6B35' }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });
            }
        });
    </script>
@endsection
