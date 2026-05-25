@extends('layouts.app')

@section('page_title', 'পণ্য তালিকা')

@section('content')
<div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>পণ্য তালিকা</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal"><i class="fas fa-plus me-2"></i>নতুন পণ্য</button>
        </div>
        <div class="bg-white p-3 rounded-4 shadow-sm mb-4 border border-light">
            <div class="row g-3">
                <div class="col-md-4"><input type="text" class="form-control" placeholder="পণ্য সার্চ করুন..."></div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option>সব ক্যাটাগরি</option>
                        <option>কম্পিউটার</option>
                        <option>পেরিফেরালস</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option>সব স্ট্যাটাস</option>
                        <option>সক্রিয়</option>
                    </select>
                </div>
                <div class="col-md-2"><button class="btn btn-outline-secondary w-100"><i class="fas fa-download me-2"></i>এক্সপোর্ট</button></div>
            </div>
        </div>
        <div class="data-table-wrapper">
            <table class="table data-table align-middle">
                <thead>
                    <tr><th>ID</th><th>নাম</th><th>ক্যাটাগরি</th><th>ব্র্যান্ড</th><th>স্টক</th><th>দাম</th><th>স্ট্যাটাস</th><th>অ্যাকশন</th></tr>
                </thead>
                <tbody>
                    <tr><td>MOUSE-01</td><td>মাউস লজিটেক B100</td><td>পেরিফেরালস</td><td>লজিটেক</td><td>৪৫ পিস</td><td>৳৪৫০</td><td><span class="badge bg-success bg-opacity-10 text-success">সক্রিয়</span></td><td><button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button></td></tr>
                    <tr><td>KEY-01</td><td>কিবোর্ড ডেল KB216</td><td>পেরিফেরালস</td><td>ডেল</td><td>২৮ পিস</td><td>৳৮০০</td><td><span class="badge bg-success bg-opacity-10 text-success">সক্রিয়</span></td><td><button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button></td></tr>
                </tbody>
            </table>
<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="addProductModalLabel">নতুন পণ্য</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">পণ্যের নাম</label>
            <input type="text" class="form-control" placeholder="পণ্যের নাম" required>
          </div>
          <div class="mb-3">
            <label class="form-label">ক্যাটাগরি</label>
            <input type="text" class="form-control" placeholder="ক্যাটাগরি" required>
          </div>
          <div class="mb-3">
            <label class="form-label">ব্র্যান্ড</label>
            <input type="text" class="form-control" placeholder="ব্র্যান্ড" required>
          </div>
          <div class="mb-3">
            <label class="form-label">স্টক</label>
            <input type="number" class="form-control" placeholder="স্টক পরিমাণ" required>
          </div>
          <div class="mb-3">
            <label class="form-label">দাম</label>
            <input type="text" class="form-control" placeholder="দাম (৳)" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
        <button type="button" class="btn btn-primary">সংরক্ষণ</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-white">
        <h5 class="modal-title" id="editProductModalLabel">পণ্য সম্পাদনা</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">পণ্যের নাম</label>
            <input type="text" class="form-control" placeholder="পণ্যের নাম" required>
          </div>
          <div class="mb-3">
            <label class="form-label">ক্যাটাগরি</label>
            <input type="text" class="form-control" placeholder="ক্যাটাগরি" required>
          </div>
          <div class="mb-3">
            <label class="form-label">ব্র্যান্ড</label>
            <input type="text" class="form-control" placeholder="ব্র্যান্ড" required>
          </div>
          <div class="mb-3">
            <label class="form-label">স্টক</label>
            <input type="number" class="form-control" placeholder="স্টক পরিমাণ" required>
          </div>
          <div class="mb-3">
            <label class="form-label">দাম</label>
            <input type="text" class="form-control" placeholder="দাম (৳)" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
        <button type="button" class="btn btn-primary">সেভ করুন</button>
      </div>
    </div>
  </div>
</div>
        </div>
    </div>
@endsection
