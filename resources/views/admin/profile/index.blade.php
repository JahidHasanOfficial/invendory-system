@extends('layouts.app')

@section('page_title', 'ব্যবহারকারী প্রোফাইল')

@section('content')
<div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="bg-white p-4 rounded-4 shadow-sm border border-light">
                    <h5 class="mb-4 text-primary-dark border-bottom pb-3"><i class="fas fa-user-circle me-2 text-primary"></i>প্রোফাইল সেটিংস</h5>
                    <div class="text-center mb-4">
                        <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=100&h=100&q=80" class="rounded-circle border border-3" style="width: 100px; height: 100px; object-fit: cover;">
                        <h5 class="mt-2 mb-1">মাহমুদ হাসান</h5>
                        <p class="text-muted">সুপার এডমিন | হেড অফিস</p>
                    </div>
                    <form onsubmit="event.preventDefault(); alert('প্রোফাইল সফলভাবে আপডেট হয়েছে!');">
                        <div class="mb-3"><label class="form-label">পূর্ণ নাম</label><input type="text" class="form-control" value="মাহমুদ হাসান" required></div>
                        <div class="mb-3"><label class="form-label">শাখা</label><input type="text" class="form-control" value="হেড অফিস" readonly></div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6"><label class="form-label">নতুন পাসওয়ার্ড</label><input type="password" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">পাসওয়ার্ড নিশ্চিত করুন</label><input type="password" class="form-control"></div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">প্রোফাইল আপডেট করুন</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
