@extends('layouts.app')

@section('page_title', 'ডাটাবেজ ব্যাকআপ ও পুনরুদ্ধার')

@section('content')
<div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="bg-white p-4 rounded-4 shadow-sm border border-light text-center">
                    <i class="fas fa-database fa-3x text-primary mb-3"></i>
                    <h5 class="text-primary-dark mb-2">ডাটাবেজ ব্যাকআপ</h5>
                    <p class="text-muted">আপনার ইনভেন্টরি সিস্টেমের যাবতীয় ডাটাবেজ ব্যাকআপ ফাইল ডাউনলোড করুন।</p>
                    <button class="btn btn-primary py-2 px-4 w-100 mt-2" onclick="alert('ডাটাবেজ ব্যাকআপ ফাইল ডাউনলোড হচ্ছে (backup_sql_2026_05_25.sql)')"><i class="fas fa-download me-2"></i>ব্যাকআপ ফাইল ডাউনলোড করুন</button>
                    <hr class="my-4">
                    <h5 class="text-primary-dark mb-2">ডাটাবেজ পুনরুদ্ধার (Restore)</h5>
                    <input type="file" class="form-control mt-3">
                    <button class="btn btn-outline-danger w-100 mt-2" onclick="alert('সফলভাবে ডাটাবেজ পুনরুদ্ধার করা হয়েছে!')">ডাটা পুনরুদ্ধার করুন</button>
                </div>
            </div>
        </div>
    </div>
@endsection
