@extends('layouts.app')

@section('page_title', 'ভাউচার টাইপ কনফিগারেশন')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>ভাউচার প্রোটোকল কনফিগারেশন</h4>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>ভাউচার প্রকার</th><th>কোডPrefix</th><th>ক্রমিক প্যাটার্ন</th><th>পরবর্তী ক্রমিক নম্বর</th><th>অবস্থা</th></tr>
                </thead>
                <tbody>
                    <tr><td>রিকুইজিশন (Requisition)</td><td>REQ</td><td>REQ-YYYY-NNNN</td><td>REQ-2026-0090</td><td><span class="badge bg-success">সক্রিয়</span></td></tr>
                    <tr><td>ক্রয় অর্ডার (PO)</td><td>PO</td><td>PO-YYYY-NNNN</td><td>PO-2026-0104</td><td><span class="badge bg-success">সক্রিয়</span></td></tr>
                    <tr><td>গুডস রিসিপ্ট (GRN)</td><td>GRN</td><td>GRN-YYYY-NNNN</td><td>GRN-2026-0126</td><td><span class="badge bg-success">সক্রিয়</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
