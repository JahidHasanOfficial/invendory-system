@extends('layouts.app')

@section('page_title', 'ব্যবহারকারী ব্যবস্থাপনা')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>ব্যবহারকারীগণ</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fas fa-plus me-2"></i>নতুন ইউজার যুক্ত করুন</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>নাম</th><th>ইউজারনেম</th><th>ভূমিকা (রোল)</th><th>শাখা</th><th>স্ট্যাটাস</th><th>অ্যাকশন</th></tr>
                </thead>
                <tbody>
                    <tr><td>মাহমুদ হাসান</td><td>mahmud.admin</td><td>সুপার এডমিন</td><td>হেড অফিস</td><td><span class="badge bg-success">সক্রিয়</span></td><td><button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button></td></tr>
                    <tr><td>কামরুল ইসলাম</td><td>kamrul.manager</td><td>শাখা ব্যবস্থাপক</td><td>গুলশান</td><td><span class="badge bg-success">সক্রিয়</span></td><td><button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
