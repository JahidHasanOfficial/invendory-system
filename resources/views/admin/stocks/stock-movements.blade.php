@extends('layouts.app')

@section('page_title', 'স্টক মুভমেন্ট রিপোর্ট')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>স্টক মুভমেন্ট লগ</h4>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>তারিখ</th><th>পণ্য</th><th>উৎস/লেনদেন</th><th>শাখা</th><th>পরিবর্তন (+/-)</th><th>নতুন মজুদ</th></tr>
                </thead>
                <tbody>
                    <tr><td>২৪/০৫/২০২৬</td><td>মাউস লজিটেক B100</td><td>GRN-2026-0125 (ক্রয়)</td><td>হেড অফিস</td><td class="text-success fw-bold">+২০</td><td>৩৩</td></tr>
                    <tr><td>২৩/০৫/২০২৬</td><td>কিবোর্ড ডেল KB216</td><td>ISS-2026-008 (ইস্যু)</td><td>উত্তরা ল্যাব-১</td><td class="text-danger fw-bold">-৫</td><td>৪</td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
