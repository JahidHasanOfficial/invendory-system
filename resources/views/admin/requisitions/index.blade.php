@extends('layouts.app')

@section('page_title', 'রিকুইজিশন তালিকা')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>রিকুইজিশন তালিকা</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRequisitionModal"><i class="fas fa-plus me-2"></i>নতুন রিকুইজিশন</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>নং</th><th>তারিখ</th><th>ব্রাঞ্চ</th><th>পণ্য</th><th>মোট মূল্য</th><th>স্ট্যাটাস</th><th>অ্যাকশন</th></tr>
                </thead>
                <tbody>
                    <tr><td>REQ-2026-0001</td><td>২০/০৫/২০২৬</td><td>উত্তরা</td><td>মাউস ২০, কিবোর্ড ১০</td><td>৳ ১৭,০০০</td><td><span class="badge-status badge-pending">পেন্ডিং (BM)</span></td><td><button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addRequisitionModal"><i class="fas fa-eye"></i></button></td></tr>
                    <tr><td>REQ-2026-0002</td><td>১৮/০৫/২০২৬</td><td>গুলশান</td><td>কম্পিউটার ২</td><td>৳ ৯০,০০০</td><td><span class="badge-status badge-in-transit">পেন্ডিং (CFO)</span></td><td><button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addRequisitionModal"><i class="fas fa-eye"></i></button></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
