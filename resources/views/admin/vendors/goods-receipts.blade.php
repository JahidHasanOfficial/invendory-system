@extends('layouts.app')

@section('page_title', 'গুডস রিসিপ্ট (GRN) লগ')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>গুডস রিসিপ্ট (GRN) লগ</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGRNModal"><i class="fas fa-truck-fast me-2"></i>নতুন গুডস রিসিপ্ট (GRN)</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>জিআরএন নম্বর</th><th>তারিখ</th><th>পিও রেফারেন্স</th><th>সরবরাহকারী</th><th>রিসিভকারী স্টোর</th><th>অবস্থা (স্ট্যাটাস)</th></tr>
                </thead>
                <tbody>
                    <tr><td>GRN-2026-0125</td><td>১৮/০৫/২০২৬</td><td>PO-2026-0095</td><td>স্টার টেক অ্যান্ড ইঞ্জিনিয়ারিং</td><td>হেড অফিস মেইন স্টোর</td><td><span class="badge bg-success">সফলভাবে প্রাপ্ত</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
