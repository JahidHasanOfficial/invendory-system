<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Models\User;

class QATest extends Command
{
    protected $signature = 'qa:test';
    protected $description = 'Run QA tests on all module views';

    public function handle()
    {
        $user = User::where('email', 'superadmin@e-laeltd.com')->first();
        if (!$user) {
            $this->error("Super admin not found!");
            return 1;
        }

        auth()->login($user);

        $modules = [
            'brands' => \App\Models\Brand::class,
            'categories' => \App\Models\ProductCategory::class,
            'units' => \App\Models\Unit::class,
            'products' => \App\Models\Product::class,
            'branches' => \App\Models\Branch::class,
            'labs' => \App\Models\Lab::class,
            'workstations' => \App\Models\Workstation::class,
            'assets' => \App\Models\AssetAssignment::class,
            'employee-assets' => \App\Models\AssetAssignment::class,
            'vendors' => \App\Models\Vendor::class,
            'purchase-orders' => \App\Models\PurchaseOrder::class,
            'goods-receipts' => \App\Models\GoodsReceipt::class,
            'requisitions' => \App\Models\Requisition::class,
            'transfers' => \App\Models\Transfer::class,
            'repairs' => \App\Models\Repair::class,
        ];

        $kernel = app()->make(\Illuminate\Contracts\Http\Kernel::class);

        foreach ($modules as $routePrefix => $modelClass) {
            $this->testRoute($kernel, "/admin/$routePrefix");
            $this->testRoute($kernel, "/admin/$routePrefix/create");
            
            if (class_exists($modelClass)) {
                $record = $modelClass::first();
                if ($record) {
                    $this->testRoute($kernel, "/admin/$routePrefix/{$record->id}/edit");
                } else {
                    $this->info(str_pad("/admin/$routePrefix/{id}/edit", 40) . " : SKIP (No records)");
                }
            }
        }
        
        $this->info("QA Test GET Routes Complete.");
        return 0;
    }

    private function testRoute($kernel, $uri)
    {
        $request = Request::create($uri, 'GET');
        $request->setUserResolver(function () {
            return auth()->user();
        });
        
        $response = $kernel->handle($request);
        $status = $response->getStatusCode();
        
        $output = str_pad($uri, 40) . " : " . $status;
        if ($status >= 500) {
            $this->error($output);
            if (isset($response->exception) && $response->exception) {
                $this->error("ERROR: " . get_class($response->exception) . ": " . $response->exception->getMessage());
                $this->error("FILE: " . $response->exception->getFile() . ":" . $response->exception->getLine());
            } else {
                $this->error("ERROR: Unknown 500 error");
            }
        } else {
            $this->info($output);
        }
    }
}
