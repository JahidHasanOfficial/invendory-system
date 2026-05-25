@extends('layouts.app')

@section('page_title', 'অ্যাসেট বরাদ্দ লগ')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>অ্যাসেট বরাদ্দ লগ</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAssignmentModal"><i class="fas fa-plus me-2"></i>অ্যাসেট বরাদ্দ দিন</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>বরাদ্দ আইডি</th><th>অ্যাসেট সিরিয়াল</th><th>বরাদ্দকৃত ব্যক্তি/ল্যাব</th><th>শাখা</th><th>তারিখ</th><th>স্ট্যাটাস</th></tr>
                </thead>
                <tbody>
                    <tr><td>ASN-2026-001</td><td>SER-DELL-001</td><td>ল্যাব-০১ (WS-01)</td><td>উত্তরা</td><td>১০/০৫/২০২৬</td><td><span class="badge bg-success">সক্রিয়</span></td></tr>
                    <tr><td>ASN-2026-002</td><td>SER-LEN-001</td><td>মো. রকিব (ইন্সট্রাক্টর)</td><td>উত্তরা</td><td>১২/০৫/২০২৬</td><td><span class="badge bg-success">সক্রিয়</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
