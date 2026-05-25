@extends('layouts.app')

@section('page_title', 'পণ্যের ক্যাটাগরি')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>পণ্যের ক্যাটাগরি</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="fas fa-plus me-2"></i>নতুন ক্যাটাগরি</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>ক্যাটাগরি আইডি</th><th>নাম</th><th>বিবরণ</th><th>পণ্য সংখ্যা</th><th>অ্যাকশন</th></tr>
                </thead>
                <tbody>
                    <tr><td>CAT-01</td><td>কম্পিউটার</td><td>ডেস্কটপ, ল্যাপটপ এবং সার্ভার সিস্টেম</td><td>১২ টি</td><td><button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="fas fa-edit"></i></button></td></tr>
                    <tr><td>CAT-02</td><td>পেরিফেরালস</td><td>মাউস, কিবোর্ড, হেডফোন এবং ইউএসবি হাব</td><td>৪৫ টি</td><td><button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="fas fa-edit"></i></button></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
