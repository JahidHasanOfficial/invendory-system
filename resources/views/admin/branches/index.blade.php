@extends('layouts.app')

@section('page_title', 'শাখা সমূহ')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>শাখা সমূহ</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBranchModal"><i class="fas fa-plus me-2"></i>নতুন শাখা</button>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title">হেড অফিস</h5>
                                <p class="text-muted small">কোড: HO</p>
                                <p class="mb-1"><i class="fas fa-map-marker-alt me-2 text-secondary"></i>উত্তরা, ঢাকা</p>
                                <p><i class="fas fa-phone me-2 text-secondary"></i>+৮৮০১৭১২৩৪৫৬০১</p>
                            </div>
                            <span class="badge bg-primary">হেড অফিস</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <small><i class="fas fa-laptop me-1"></i> ১৫ কম্পিউটার</small>
                            <small><i class="fas fa-boxes me-1"></i> ১২০ পণ্য</small>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addBranchModal"><i class="fas fa-eye"></i> দেখুন</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title">উত্তরা ট্রেনিং সেন্টার</h5>
                                <p class="text-muted small">কোড: UTT</p>
                                <p class="mb-1"><i class="fas fa-map-marker-alt me-2 text-secondary"></i>উত্তরা সেক্টর ১০</p>
                                <p><i class="fas fa-phone me-2 text-secondary"></i>+৮৮০১৭১২৩৪৫৬০২</p>
                            </div>
                            <span class="badge bg-success">ট্রেনিং সেন্টার</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <small><i class="fas fa-laptop me-1"></i> ৪৫ কম্পিউটার</small>
                            <small><i class="fas fa-boxes me-1"></i> ২৫০ পণ্য</small>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addBranchModal"><i class="fas fa-eye"></i> দেখুন</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
