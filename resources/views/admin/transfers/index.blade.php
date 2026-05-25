@extends('layouts.app')

@section('page_title', 'স্টক স্থানান্তর তালিকা')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>স্টক স্থানান্তর তালিকা</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransferModal"><i class="fas fa-plus me-2"></i>নতুন স্থানান্তর</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>স্থানান্তর নং</th><th>তারিখ</th><th>উৎস</th><th>গন্তব্য</th><th>পণ্য</th><th>কুরিয়ার</th><th>স্ট্যাটাস</th><th>অ্যাকশন</th></tr>
                </thead>
                <tbody>
                    <tr><td>TRF-2026-0052</td><td>২০/০৫/২০২৬</td><td>উত্তরা</td><td>গুলশান</td><td>মাউস ২০ পিস</td><td>রেডএক্স (TRK-123)</td><td><span class="badge-status badge-in-transit">ইন ট্রানজিট</span></td><td><button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addTransferModal"><i class="fas fa-eye"></i></button></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
