@extends('layouts.app')

@section('title', 'প্রোফাইল')

@section('content')
<div class="container-fluid p-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="h4 mb-0 text-gray-800">{{ __('Profile') }}</h2>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-12 col-lg-8">
            <div class="card shadow-sm border-0 mb-4 rounded-4">
                <div class="card-body p-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4 rounded-4">
                <div class="card-body p-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
