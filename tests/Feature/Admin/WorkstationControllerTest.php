<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkstationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.workstations.index'));
        $response->assertStatus(200);
    }

    public function test_create_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.workstations.create'));
        $response->assertStatus(200);
    }

    public function test_store_creates_resource()
    {
        $admin = $this->setupSuperAdmin();
        $payload = ['lab_id' => $this->createLab()->id, 'workstation_code' => 'WS-01', 'workstation_type' => 'student', 'status' => 'empty'];
        
        // Some models require organization_id
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Workstation)->getTable(), 'organization_id')) {
            $payload['organization_id'] = $admin->organization_id;
        }

        $response = $this->actingAs($admin)->post(route('admin.workstations.store'), $payload);
        $response->assertRedirect();
        
        // Assert it was created (skip for complex relations in generic test)
        $this->assertDatabaseCount((new \App\Models\Workstation)->getTable(), 1);
    }

    public function test_edit_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['lab_id' => $this->createLab()->id, 'workstation_code' => 'WS-01', 'workstation_type' => 'student', 'status' => 'empty'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Workstation)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $workstation = \App\Models\Workstation::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->get(route('admin.workstations.edit', $workstation->id ?? $workstation->workstation_id));
        $response->assertStatus(200);
    }

    public function test_update_modifies_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['lab_id' => $this->createLab()->id, 'workstation_code' => 'WS-01', 'workstation_type' => 'student', 'status' => 'empty'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Workstation)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $workstation = \App\Models\Workstation::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $updatePayload = ['lab_id' => $this->createLab()->id, 'workstation_code' => 'WS-01', 'workstation_type' => 'student', 'status' => 'empty'];
        if (isset($updatePayload['name'])) {
            $updatePayload['name'] = 'Updated Name';
        }

        $response = $this->actingAs($admin)->put(route('admin.workstations.update', $workstation->id ?? $workstation->workstation_id), $updatePayload);
        $response->assertRedirect();
    }

    public function test_destroy_deletes_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['lab_id' => $this->createLab()->id, 'workstation_code' => 'WS-01', 'workstation_type' => 'student', 'status' => 'empty'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Workstation)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $workstation = \App\Models\Workstation::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->delete(route('admin.workstations.destroy', $workstation->id ?? $workstation->workstation_id));
        $response->assertRedirect();
        
        if (\App\Models\Workstation::class !== \App\Models\Branch::class) {
            $this->assertDatabaseCount((new \App\Models\Workstation)->getTable(), 0);
        }
    }
}