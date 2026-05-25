@extends('layouts.app')

@section('page_title', 'সিস্টেম সেটিংস')

@section('content')
<div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="bg-white p-4 rounded-4 shadow-sm border border-light">
                    <h5 class="mb-4 text-primary-dark border-bottom pb-3"><i class="fas fa-sliders me-2 text-primary"></i>সিস্টেম কনফিগারেশন</h5>
                    <form onsubmit="event.preventDefault(); alert('সেটিংস সংরক্ষিত!');">
                        <div class="mb-3"><label class="form-label">প্রতিষ্ঠানের নাম</label><input type="text" class="form-control" value="e-laeltd.com" required></div>
                        <div class="mb-3"><label class="form-label">প্রাথমিক মেইলিং ইমেইল</label><input type="email" class="form-control" value="info@e-laeltd.com" required></div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6"><label class="form-label">ডিফল্ট লো-স্টক লেভেল</label><input type="number" class="form-control" value="10"></div>
                            <div class="col-md-6"><label class="form-label">ডিফল্ট ল্যাব শাখা</label><select class="form-select"><option>উত্তরা ট্রেনিং সেন্টার</option></select></div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">সেটিংস সেভ করুন</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
