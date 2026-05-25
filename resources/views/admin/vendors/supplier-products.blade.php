@extends('layouts.app')

@section('page_title', 'সাপ্লায়ার পণ্য তালিকা')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>সাপ্লায়ার পণ্য ম্যাপিং</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierProductModal"><i class="fas fa-plus me-2"></i>পণ্যের সোর্সিং যুক্ত করুন</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>পণ্যের নাম</th><th>সাপ্লায়ার/ভেন্ডর</th><th>চুক্তি মূল্য</th><th>লিড টাইম (দিন)</th><th>চুক্তির মেয়াদ</th></tr>
                </thead>
                <tbody>
                    <tr><td>মাউস লজিটেক B100</td><td>স্টার টেক অ্যান্ড ইঞ্জিনিয়ারিং</td><td>৳ ৪৫০</td><td>৩ দিন</td><td>৩১/১২/২০২৬</td></tr>
                    <tr><td>কিবোর্ড ডেল KB216</td><td>স্টার টেক অ্যান্ড ইঞ্জিনিয়ারিং</td><td>৳ ৮০০</td><td>৩ দিন</td><td>৩১/১২/২০২৬</td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
