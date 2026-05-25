@extends('layouts.app')

@section('page_title', 'ওয়ার্কস্টেশন সমূহ')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>ওয়ার্কস্টেশন সমূহ</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWorkstationModal"><i class="fas fa-plus me-2"></i>ওয়ার্কস্টেশন যোগ করুন</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>আইডি</th><th>ল্যাব অবস্থান</th><th>সংযুক্ত সিপিইউ</th><th>সংযুক্ত মনিটর</th><th>ব্যবহারকারী</th><th>অবস্থা</th></tr>
                </thead>
                <tbody>
                    <tr><td>WS-01</td><td>উত্তরা ল্যাব-১</td><td>SER-CPU-DELL-101</td><td>SER-MON-LG-301</td><td>মোহাম্মদ রফিক (শিক্ষার্থী)</td><td><span class="badge bg-success bg-opacity-10 text-success">সক্রিয়</span></td></tr>
                    <tr><td>WS-02</td><td>উত্তরা ল্যাব-১</td><td>SER-CPU-DELL-102</td><td>SER-MON-LG-302</td><td>তানভীর আহমেদ (শিক্ষার্থী)</td><td><span class="badge bg-success bg-opacity-10 text-success">সক্রিয়</span></td></tr>
                    <tr><td>WS-03</td><td>উত্তরা ল্যাব-১</td><td>SER-CPU-DELL-103</td><td>SER-MON-LG-303</td><td>--</td><td><span class="badge bg-danger bg-opacity-10 text-danger">মেরামত প্রয়োজন</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
