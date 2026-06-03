<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Organization;

class StockMovementControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_view_stock_movements_page()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.stock-movements.index'));
        $response->assertStatus(200);
    }

    public function test_user_without_permission_cannot_view_stock_movements_page()
    {
        $org = Organization::firstOrCreate(['id' => 1], ['name' => 'Default Organization']);
        $user = User::factory()->create(['organization_id' => $org->id]);

        $response = $this->actingAs($user)->get(route('admin.stock-movements.index'));
        $response->assertStatus(403);
    }
}
