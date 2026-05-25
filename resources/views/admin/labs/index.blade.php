@extends('layouts.app')

@section('page_title', 'ল্যাব সমূহ')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>ল্যাব সমূহ</h4>
            <select class="form-select w-auto" id="branchSelect">
                <option>উত্তরা ট্রেনিং সেন্টার</option>
                <option>গুলশান ট্রেনিং সেন্টার</option>
                <option>চট্টগ্রাম ট্রেনিং সেন্টার</option>
            </select>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-transparent border-0 pt-4">
                        <h5><i class="fas fa-chalkboard me-2 text-primary"></i>ল্যাব-০১ (মেইন ল্যাব)</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2"><span>মোট ওয়ার্কস্টেশন:</span><strong>২৫টি</strong></div>
                        <div class="d-flex justify-content-between mb-2"><span>ব্যবহৃত:</span><strong class="text-success">১৫টি</strong></div>
                        <div class="d-flex justify-content-between mb-2"><span>খালি:</span><strong class="text-secondary">১০টি</strong></div>
                        <div class="progress mb-3" style="height: 8px;"><div class="progress-bar bg-success" style="width: 60%"></div></div>
                        <div class="d-flex justify-content-between text-muted" style="font-size:12px;">
                            <span><i class="fas fa-mouse"></i> মাউস: ২৫</span>
                            <span><i class="fas fa-keyboard"></i> কিবোর্ড: ২০</span>
                            <span><i class="fas fa-tv"></i> মনিটর: ১৫</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4">
                        <button class="btn btn-outline-primary w-100" onclick="location.href='lab-stock.html'">ল্যাব দেখুন</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
