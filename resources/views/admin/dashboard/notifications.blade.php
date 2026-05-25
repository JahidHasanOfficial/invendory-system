@extends('layouts.app')

@section('page_title', 'নোটিফিকেশন সেন্টার')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>নোটিফিকেশন সমূহ</h4>
            <button class="btn btn-outline-secondary" onclick="alert('সব নোটিফিকেশন পড়া হয়েছে!')">সব নোটিফিকেশন পড়া হয়েছে মার্ক করুন</button>
        </div>
        <div class="bg-white p-4 rounded-4 shadow-sm border border-light">
            <div class="list-group list-group-flush">
                <div class="list-group-item py-3 border-0 border-bottom bg-light bg-opacity-25">
                    <div class="d-flex justify-content-between mb-1"><strong>নতুন রিকুইজিশন অনুরোধ</strong><small class="text-muted">১০ মিনিট আগে</small></div>
                    <p class="mb-0 text-muted">উত্তরা শাখা থেকে ২৫টি লজিটেক মাউসের আবেদন অনুমোদনের জন্য অপেক্ষা করছে।</p>
                </div>
                <div class="list-group-item py-3 border-0 border-bottom">
                    <div class="d-flex justify-content-between mb-1"><strong class="text-warning-custom">লো স্টক এলার্ট!</strong><small class="text-muted">১ ঘণ্টা আগে</small></div>
                    <p class="mb-0 text-muted">HP টোনার কার্টিজের স্টক রি-অর্ডার লেভেলের নিচে নেমে গেছে।</p>
                </div>
            </div>
        </div>
    </div>
@endsection
