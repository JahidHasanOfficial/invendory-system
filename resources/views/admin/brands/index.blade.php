@extends('layouts.app')

@section('page_title', 'ব্র্যান্ড সমূহ')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>ব্র্যান্ড সমূহ</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrandModal"><i class="fas fa-plus me-2"></i>নতুন ব্র্যান্ড</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>ব্র্যান্ড আইডি</th><th>নাম</th><th>উৎপত্তি দেশ</th><th>স্ট্যাটাস</th><th>অ্যাকশন</th></tr>
                </thead>
                <tbody>
                    <tr><td>BRD-01</td><td>ডেল (Dell)</td><td>যুক্তরাষ্ট্র</td><td><span class="badge bg-success bg-opacity-10 text-success">সক্রিয়</span></td><td><button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addBrandModal"><i class="fas fa-edit"></i></button></td></tr>
                    <tr><td>BRD-02</td><td>লজিটেক (Logitech)</td><td>সুইজারল্যান্ড</td><td><span class="badge bg-success bg-opacity-10 text-success">সক্রিয়</span></td><td><button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addBrandModal"><i class="fas fa-edit"></i></button></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
