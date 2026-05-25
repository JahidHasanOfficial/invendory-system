@extends('layouts.app')

@section('page_title', 'অ্যাসেট ট্র্যাকিং')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>অ্যাসেট ট্র্যাকিং</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAssetModal"><i class="fas fa-plus me-2"></i>নতুন সিরিয়াল রেজিস্টার করুন</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>সিরিয়াল নম্বর</th><th>অ্যাসেট নাম</th><th>ব্র্যান্ড</th><th>অবস্থান</th><th>স্ট্যাটাস</th></tr>
                </thead>
                <tbody>
                    <tr><td>SER-DELL-001</td><td>ডেল অপটিপ্লেক্স ৩০৮০</td><td>ডেল</td><td>উত্তরা ল্যাব-১ (WS-01)</td><td><span class="badge bg-success">বরাদ্দকৃত</span></td></tr>
                    <tr><td>SER-LEN-001</td><td>লেনোভো থিংকপ্যাড E14</td><td>লেনোভো</td><td>মো. রকিব (ট্রেনার)</td><td><span class="badge bg-success">বরাদ্দকৃত</span></td></tr>
                    <tr><td>SER-DELL-002</td><td>ডেল অপটিপ্লেক্স ৩০৮০</td><td>ডেল</td><td>রিপেয়ারে</td><td><span class="badge bg-warning text-dark">মেরামতাধীন</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
