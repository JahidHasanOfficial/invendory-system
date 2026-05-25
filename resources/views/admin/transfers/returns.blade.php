@extends('layouts.app')

@section('page_title', 'স্টোর রিটার্ন লগ')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>স্টোর রিটার্ন লগ</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReturnModal"><i class="fas fa-undo-alt me-2"></i>রিটার্ন গ্রহণ করুন</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>রিটার্ন ভাউচার</th><th>তারিখ</th><th>শাখা/কর্মকর্তা</th><th>আইটেম</th><th>সিরিয়াল নম্বর/পরিমাণ</th><th>কারণ</th><th>অবস্থা</th></tr>
                </thead>
                <tbody>
                    <tr><td>RTN-2026-003</td><td>২৩/০৫/২০২৬</td><td>উত্তরা ট্রেনিং সেন্টার</td><td>ডেল অপটিপ্লেক্স পিসি</td><td>SER-DELL-002</td><td>মাদারবোর্ড নষ্ট (রিপেয়ারযোগ্য)</td><td><span class="badge bg-warning text-dark">স্টোরে ফেরত</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
