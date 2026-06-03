<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\LabController;
use App\Http\Controllers\Admin\WorkstationController;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\EmployeeAssetController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\GoodsReceiptController;
use App\Http\Controllers\Admin\RequisitionController;
use App\Http\Controllers\Admin\TransferController;
use App\Http\Controllers\Admin\RepairController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StockMovementController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->permissions('profile.view');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->permissions('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->permissions('profile.delete');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Roles & Permissions
    Route::resource('roles', RoleController::class)->except(['create', 'edit', 'show']);
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');

    // Brands
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index')->permissions('brands.view');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create')->permissions('brands.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store')->permissions('brands.create');
    Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit')->permissions('brands.edit');
    Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update')->permissions('brands.edit');
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy')->permissions('brands.delete');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index')->permissions('categories.view');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create')->permissions('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store')->permissions('categories.create');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->permissions('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update')->permissions('categories.edit');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->permissions('categories.delete');

    // Units
    Route::get('/units', [UnitController::class, 'index'])->name('units.index')->permissions('units.view');
    Route::get('/units/create', [UnitController::class, 'create'])->name('units.create')->permissions('units.create');
    Route::post('/units', [UnitController::class, 'store'])->name('units.store')->permissions('units.create');
    Route::get('/units/{unit}/edit', [UnitController::class, 'edit'])->name('units.edit')->permissions('units.edit');
    Route::put('/units/{unit}', [UnitController::class, 'update'])->name('units.update')->permissions('units.edit');
    Route::delete('/units/{unit}', [UnitController::class, 'destroy'])->name('units.destroy')->permissions('units.delete');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index')->permissions('products.view');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->permissions('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store')->permissions('products.create');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->permissions('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update')->permissions('products.edit');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->permissions('products.delete');

    // Branches
    Route::get('branches', [BranchController::class, 'index'])->name('branches.index')->permissions('branches.view');
    Route::get('branches/create', [BranchController::class, 'create'])->name('branches.create')->permissions('branches.create');
    Route::post('branches', [BranchController::class, 'store'])->name('branches.store')->permissions('branches.create');
    Route::get('branches/{branch}/edit', [BranchController::class, 'edit'])->name('branches.edit')->permissions('branches.edit');
    Route::put('branches/{branch}', [BranchController::class, 'update'])->name('branches.update')->permissions('branches.edit');
    Route::delete('branches/{branch}', [BranchController::class, 'destroy'])->name('branches.destroy')->permissions('branches.delete');
    
    // Labs
    Route::get('labs', [LabController::class, 'index'])->name('labs.index')->permissions('labs.view');
    Route::get('labs/create', [LabController::class, 'create'])->name('labs.create')->permissions('labs.create');
    Route::post('labs', [LabController::class, 'store'])->name('labs.store')->permissions('labs.create');
    Route::get('labs/{lab}/edit', [LabController::class, 'edit'])->name('labs.edit')->permissions('labs.edit');
    Route::put('labs/{lab}', [LabController::class, 'update'])->name('labs.update')->permissions('labs.edit');
    Route::delete('labs/{lab}', [LabController::class, 'destroy'])->name('labs.destroy')->permissions('labs.delete');
    
    // Workstations
    Route::get('workstations', [WorkstationController::class, 'index'])->name('workstations.index')->permissions('workstations.view');
    Route::get('workstations/create', [WorkstationController::class, 'create'])->name('workstations.create')->permissions('workstations.create');
    Route::post('workstations', [WorkstationController::class, 'store'])->name('workstations.store')->permissions('workstations.create');
    Route::get('workstations/{workstation}/edit', [WorkstationController::class, 'edit'])->name('workstations.edit')->permissions('workstations.edit');
    Route::put('workstations/{workstation}', [WorkstationController::class, 'update'])->name('workstations.update')->permissions('workstations.edit');
    Route::delete('workstations/{workstation}', [WorkstationController::class, 'destroy'])->name('workstations.destroy')->permissions('workstations.delete');
    
    // Assets (Asset Assignments)
    Route::get('assets', [AssetController::class, 'index'])->name('assets.index')->permissions('assets.view');
    Route::get('assets/create', [AssetController::class, 'create'])->name('assets.create')->permissions('assets.create');
    Route::post('assets', [AssetController::class, 'store'])->name('assets.store')->permissions('assets.create');
    Route::get('assets/{asset}/edit', [AssetController::class, 'edit'])->name('assets.edit')->permissions('assets.edit');
    Route::put('assets/{asset}', [AssetController::class, 'update'])->name('assets.update')->permissions('assets.edit');
    Route::delete('assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy')->permissions('assets.delete');
    
    Route::get('employee-assets', [EmployeeAssetController::class, 'index'])->name('employee-assets.index')->permissions('employee-assets.view');

    // Vendors
    Route::get('vendors', [VendorController::class, 'index'])->name('vendors.index')->permissions('vendors.view');
    Route::get('vendors/create', [VendorController::class, 'create'])->name('vendors.create')->permissions('vendors.create');
    Route::post('vendors', [VendorController::class, 'store'])->name('vendors.store')->permissions('vendors.create');
    Route::get('vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('vendors.edit')->permissions('vendors.edit');
    Route::put('vendors/{vendor}', [VendorController::class, 'update'])->name('vendors.update')->permissions('vendors.edit');
    Route::delete('vendors/{vendor}', [VendorController::class, 'destroy'])->name('vendors.destroy')->permissions('vendors.delete');

    // Purchase Orders
    Route::get('purchase-orders', [PurchaseOrderController::class, 'index'])->name('purchase-orders.index')->permissions('purchase-orders.view');
    Route::get('purchase-orders/create', [PurchaseOrderController::class, 'create'])->name('purchase-orders.create')->permissions('purchase-orders.create');
    Route::post('purchase-orders', [PurchaseOrderController::class, 'store'])->name('purchase-orders.store')->permissions('purchase-orders.create');
    Route::get('purchase-orders/{purchase_order}/edit', [PurchaseOrderController::class, 'edit'])->name('purchase-orders.edit')->permissions('purchase-orders.edit');
    Route::put('purchase-orders/{purchase_order}', [PurchaseOrderController::class, 'update'])->name('purchase-orders.update')->permissions('purchase-orders.edit');
    Route::delete('purchase-orders/{purchase_order}', [PurchaseOrderController::class, 'destroy'])->name('purchase-orders.destroy')->permissions('purchase-orders.delete');

    // Goods Receipts
    Route::get('goods-receipts', [GoodsReceiptController::class, 'index'])->name('goods-receipts.index')->permissions('goods-receipts.view');
    Route::get('goods-receipts/create', [GoodsReceiptController::class, 'create'])->name('goods-receipts.create')->permissions('goods-receipts.create');
    Route::post('goods-receipts', [GoodsReceiptController::class, 'store'])->name('goods-receipts.store')->permissions('goods-receipts.create');
    Route::get('goods-receipts/{goods_receipt}/edit', [GoodsReceiptController::class, 'edit'])->name('goods-receipts.edit')->permissions('goods-receipts.edit');
    Route::put('goods-receipts/{goods_receipt}', [GoodsReceiptController::class, 'update'])->name('goods-receipts.update')->permissions('goods-receipts.edit');
    Route::delete('goods-receipts/{goods_receipt}', [GoodsReceiptController::class, 'destroy'])->name('goods-receipts.destroy')->permissions('goods-receipts.delete');

    // Requisitions
    Route::get('requisitions', [RequisitionController::class, 'index'])->name('requisitions.index')->permissions('requisitions.view');
    Route::get('requisitions/create', [RequisitionController::class, 'create'])->name('requisitions.create')->permissions('requisitions.create');
    Route::post('requisitions', [RequisitionController::class, 'store'])->name('requisitions.store')->permissions('requisitions.create');
    Route::get('requisitions/{requisition}/edit', [RequisitionController::class, 'edit'])->name('requisitions.edit')->permissions('requisitions.edit');
    Route::put('requisitions/{requisition}', [RequisitionController::class, 'update'])->name('requisitions.update')->permissions('requisitions.edit');
    Route::delete('requisitions/{requisition}', [RequisitionController::class, 'destroy'])->name('requisitions.destroy')->permissions('requisitions.delete');

    // Transfers
    Route::get('transfers', [TransferController::class, 'index'])->name('transfers.index')->permissions('transfers.view');
    Route::get('transfers/create', [TransferController::class, 'create'])->name('transfers.create')->permissions('transfers.create');
    Route::post('transfers', [TransferController::class, 'store'])->name('transfers.store')->permissions('transfers.create');
    Route::get('transfers/{transfer}/edit', [TransferController::class, 'edit'])->name('transfers.edit')->permissions('transfers.edit');
    Route::put('transfers/{transfer}', [TransferController::class, 'update'])->name('transfers.update')->permissions('transfers.edit');
    Route::delete('transfers/{transfer}', [TransferController::class, 'destroy'])->name('transfers.destroy')->permissions('transfers.delete');

    // Repairs
    Route::get('repairs', [RepairController::class, 'index'])->name('repairs.index')->permissions('repairs.view');
    Route::get('repairs/create', [RepairController::class, 'create'])->name('repairs.create')->permissions('repairs.create');
    Route::post('repairs', [RepairController::class, 'store'])->name('repairs.store')->permissions('repairs.create');
    Route::get('repairs/{repair}/edit', [RepairController::class, 'edit'])->name('repairs.edit')->permissions('repairs.edit');
    Route::put('repairs/{repair}', [RepairController::class, 'update'])->name('repairs.update')->permissions('repairs.edit');
    Route::delete('repairs/{repair}', [RepairController::class, 'destroy'])->name('repairs.destroy')->permissions('repairs.delete');

    // Extra scaffold routes
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index')->permissions('settings.view');
    Route::get('stocks', [StockController::class, 'index'])->name('stocks.index')->permissions('stocks.view');
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index')->permissions('reports.view');
    Route::get('stock-movements', [StockMovementController::class, 'index'])->name('stock-movements.index')->permissions('stock-movements.view');
});

require __DIR__.'/auth.php';
