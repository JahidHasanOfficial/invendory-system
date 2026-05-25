@extends('layouts.app')

@section('page_title', 'ক্রয় অর্ডার (PO) সমূহ')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>ক্রয় অর্ডার (PO) সমূহ</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPOModal"><i class="fas fa-plus me-2"></i>নতুন ক্রয় অর্ডার (PO)</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>অর্ডার নম্বর</th><th>তারিখ</th><th>ভেন্ডর/সরবরাহকারী</th><th>মোট মূল্য</th><th>ডেলিভারি তারিখ</th><th>অনুমোদনের অবস্থা</th></tr>
                </thead>
                <tbody>
                    <tr><td>PO-2026-0102</td><td>১৯/০৫/২০২৬</td><td>স্টার টেক অ্যান্ড ইঞ্জিনিয়ারিং</td><td>৳ ২,৪০,০০০</td><td>২৮/০৫/২০২৬</td><td><span class="badge bg-success">অনুমোদিত (CFO)</span></td></tr>
                    <tr><td>PO-2026-0103</td><td>২৪/০৫/২০২৬</td><td>রয়্যাল প্লাস্টিকস</td><td>৳ ১৫,০০০</td><td>৩০/০৫/২০২৬</td><td><span class="badge bg-warning text-dark">খসড়া (Draft)</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
