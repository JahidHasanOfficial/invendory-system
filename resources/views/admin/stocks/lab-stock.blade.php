@extends('layouts.app')

@section('page_title', 'ল্যাব স্টক ট্র্যাকিং')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>ল্যাব স্টক ট্র্যাকিং</h4>
            <select class="form-select w-auto">
                <option>উত্তরা ট্রেনিং সেন্টার</option>
            </select>
        </div>
        <div class="bg-white p-2 rounded-4 shadow-sm mb-4 border border-light">
            <ul class="nav nav-tabs border-bottom-0">
                <li class="nav-item"><button class="nav-link active">ল্যাব-০১ (মেইন ল্যাব)</button></li>
                <li class="nav-item"><button class="nav-link" style="color:var(--gray)">ল্যাব-০২</button></li>
            </ul>
        </div>
        <div class="workstation-grid mt-4">
            <div class="workstation-item occupied" data-bs-toggle="modal" data-bs-target="#wsDetailsModal">
                <i class="fas fa-desktop ws-icon"></i><div class="ws-name">WS-01</div><div class="ws-status-text">ব্যবহৃত</div>
            </div>
            <div class="workstation-item occupied">
                <i class="fas fa-desktop ws-icon"></i><div class="ws-name">WS-02</div><div class="ws-status-text">ব্যবহৃত</div>
            </div>
            <div class="workstation-item repair">
                <i class="fas fa-desktop ws-icon"></i><div class="ws-name">WS-03</div><div class="ws-status-text">নষ্ট</div>
            </div>
            <div class="workstation-item empty">
                <i class="fas fa-desktop ws-icon"></i><div class="ws-name">WS-04</div><div class="ws-status-text">ফাঁকা</div>
            </div>
        </div>
    </div>
@endsection
