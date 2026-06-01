<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeAssetControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.employee-assets.index'));
        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_access_index()
    {
        $response = $this->get(route('admin.employee-assets.index'));
        $response->assertRedirect(route('login'));
    }

}
