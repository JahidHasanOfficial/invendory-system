@extends('layouts.app')

@section('page_title', 'ভেন্ডার তালিকা')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>ভেন্ডার / সাপ্লায়ার তালিকা</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVendorModal"><i class="fas fa-plus me-2"></i>নতুন ভেন্ডার যুক্ত করুন</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>ভেন্ডর আইডি</th><th>কোম্পানির নাম</th><th>প্রতিনিধি</th><th>মোবাইল নম্বর</th><th>ইমেইল</th><th>সাপ্লাই ক্যাটাগরি</th></tr>
                </thead>
                <tbody>
                    <tr><td>VND-001</td><td>স্টার টেক অ্যান্ড ইঞ্জিনিয়ারিং</td><td>মি. জাহিদ হাসান</td><td>01677889900</td><td>corporate@startech.com</td><td>আইটি ও হার্ডওয়্যার</td></tr>
                    <tr><td>VND-002</td><td>রয়্যাল স্টেশনারি</td><td>মো. আরিফ বিল্লাহ</td><td>01988776655</td><td>royal@stationery.com</td><td>অফিস স্টেশনারি</td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
