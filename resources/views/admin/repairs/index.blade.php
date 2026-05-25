@extends('layouts.app')

@section('page_title', 'রিপেয়ার/সার্ভিসিং')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>রিপেয়ার/সার্ভিসিং ট্র্যাকিং</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRepairModal"><i class="fas fa-plus me-2"></i>মেরামত তালিকায় যোগ করুন</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>ভাউচার আইডি</th><th>তারিখ</th><th>শাখা</th><th>ডিভাইস নাম</th><th>সিরিয়াল নম্বর</th><th>ভেন্ডর</th><th>খরচ</th><th>স্ট্যাটাস</th></tr>
                </thead>
                <tbody>
                    <tr><td>RPR-2026-0012</td><td>১৫/০৫/২০২৬</td><td>গুলশান</td><td>ডেল অপটিপ্লেক্স ৩০৮০</td><td>SER-DELL-002</td><td>স্টার টেক সার্ভিস</td><td>--</td><td><span class="badge-status badge-pending">মেরামত চলছে</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
