@extends('layouts.app')

@section('page_title', 'অনুমোদনের লগ')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>অনুমোদনের ইতিহাস লগ</h4>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>ভাউচার আইডি</th><th>ধরণ</th><th>শাখা</th><th>আবেদনকারী</th><th>অনুমোদনকারী</th><th>তারিখ</th><th>মন্তব্য</th></tr>
                </thead>
                <tbody>
                    <tr><td>REQ-2026-0088</td><td>রিকুইজিশন</td><td>গুলশান</td><td>আরিফিন সিদ্দিকী</td><td>মাহমুদ হাসান (Admin)</td><td>২২/০৫/২০২৬</td><td>জরুরি ল্যাব সংস্কারের জন্য অনুমোদিত</td></tr>
                    <tr><td>PO-2026-0102</td><td>ক্রয় অর্ডার (PO)</td><td>হেড অফিস</td><td>কামরুল ইসলাম</td><td>মি. রহমান (CFO)</td><td>১৯/০৫/২০২৬</td><td>বাজেট ও চুক্তি অনুযায়ী অনুমোদিত</td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
