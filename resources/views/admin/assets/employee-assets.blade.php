@extends('layouts.app')

@section('page_title', 'এমপ্লয়ি অ্যাসেট ট্র্যাকিং')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>এমপ্লয়ি অ্যাসেট ট্র্যাকিং</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeAssetModal"><i class="fas fa-plus me-2"></i>এমপ্লয়ি বরাদ্দ যোগ করুন</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>কর্মকর্তার নাম</th><th>পদবি</th><th>শাখা</th><th>বরাদ্দকৃত ল্যাপটপ/ডিভাইস</th><th>সিরিয়াল নম্বর</th><th>বরাদ্দ তারিখ</th></tr>
                </thead>
                <tbody>
                    <tr><td>মো. রকিব হোসেন</td><td>প্রধান ট্রেনার</td><td>উত্তরা</td><td>লেনোভো থিংকপ্যাড E14</td><td>SER-LEN-001</td><td>১২/০৫/২০২৬</td></tr>
                    <tr><td>সুলতানা পারভীন</td><td>সহকারী ট্রেনার</td><td>গুলশান</td><td>ডেল ল্যাপটপ Vostro</td><td>SER-DELL-L45</td><td>১৫/০৫/২০২৬</td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
