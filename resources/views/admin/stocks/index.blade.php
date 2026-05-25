@extends('layouts.app')

@section('page_title', 'বর্তমান স্টক অবস্থা')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>বর্তমান স্টক অবস্থা</h4>
            <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addStockModal"><i class="fas fa-download me-2"></i>স্টক অডিট শীট</button>
        </div>
        <div class="bg-white p-4 rounded-4 shadow-sm border border-light">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>পণ্যের নাম</th><th>মোট মজুদ</th><th>হেড অফিস</th><th>উত্তরা</th><th>গুলশান</th><th>চট্টগ্রাম</th></tr>
                </thead>
                <tbody>
                    <tr><td><strong>মাউস লজিটেক B100</strong></td><td class="fw-bold">৪৫</td><td>৩৩</td><td>৫</td><td>৪</td><td>৩</td></tr>
                    <tr><td><strong>কিবোর্ড ডেল KB216</strong></td><td class="fw-bold">২৮</td><td>১৮</td><td>৪</td><td>৪</td><td>২</td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
