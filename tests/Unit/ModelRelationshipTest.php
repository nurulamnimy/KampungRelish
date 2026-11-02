<?php

namespace Tests\Unit;

use App\Models\Experience;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_vendor_has_many_experiences()
    {
        $vendor = VendorProfile::create(['name' => 'V', 'phone' => '0821234567', 'location' => 'Kuching', 'status' => 'active']);
        Experience::create(['vendor_profile_id' => $vendor->id, 'name' => 'A', 'location' => 'Kuching',
            'category' => 'Food Tour', 'description' => 'x', 'price' => 10, 'status' => 'active']);

        $this->assertEquals(1, $vendor->experiences()->count());
        $this->assertEquals($vendor->id, Experience::first()->vendor->id);
    }

    public function test_user_is_admin_helper()
    {
        $admin = new User(['role' => 'admin']);
        $user = new User(['role' => 'user']);
        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($user->isAdmin());
    }
}
