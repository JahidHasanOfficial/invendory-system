@extends('layouts.app')

@section('page_title', 'অডিট ট্রেইল')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>অডিট ট্রেইল লগ</h4>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>সময়</th><th>ব্যবহারকারী</th><th>আইপি এড্রেস</th><th>কার্যক্রম</th><th>বিবরণ</th></tr>
                </thead>
                <tbody>
                    <tr><td>২৫/০৫/২০২৬ ০৯:৩০ AM</td><td>মাহমুদ হাসান (Super Admin)</td><td>192.168.1.52</td><td>লগইন</td><td>সফলভাবে অ্যাকাউন্টে প্রবেশ সম্পন্ন</td></tr>
                    <tr><td>২৪/০৫/২০২৬ ০৪:১৫ PM</td><td>কামরুল ইসলাম (Manager)</td><td>192.168.1.10</td><td>পণ্য সম্পাদন</td><td>মাউস লজিটেক B100 এর স্টক আপডেট</td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
