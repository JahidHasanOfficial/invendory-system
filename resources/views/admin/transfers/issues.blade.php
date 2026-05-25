@extends('layouts.app')

@section('page_title', 'স্টোর ইস্যু লগ')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>স্টোর ইস্যু লগ</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addIssueModal"><i class="fas fa-plus me-2"></i>মালামাল ইস্যু করুন</button>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>ইস্যু স্লিপ নং</th><th>তারিখ</th><th>ইস্যুকারী বিভাগ/শাখা</th><th>গ্রহীতা</th><th>আইটেম</th><th>পরিমাণ</th><th>অনুমোদনকারী</th></tr>
                </thead>
                <tbody>
                    <tr><td>ISS-2026-009</td><td>২৪/০৫/২০২৬</td><td>উত্তরা ল্যাব-১</td><td>মো. রকিব (প্রধান ট্রেনার)</td><td>লজিটেক মাউস</td><td>৫ পিস</td><td>এডমিন অফিসার</td></tr>
                    <tr><td>ISS-2026-008</td><td>২২/০৫/২০২৬</td><td>অফিস স্টেশনারি</td><td>শায়লা সাবরিন (স্টাফ)</td><td>এ৪ সাইজ পেপার</td><td>২ রিম</td><td>এডমিন অফিসার</td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
