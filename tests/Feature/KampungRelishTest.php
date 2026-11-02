<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Experience;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class KampungRelishTest extends TestCase
{
    use RefreshDatabase;

    private function makeAdmin(): User
    {
        return User::create(['name' => 'Admin', 'email' => 'admin@test.com', 'phone' => '0123456789',
            'password' => Hash::make('admin123'), 'role' => 'admin']);
    }

    private function makeUser(): User
    {
        return User::create(['name' => 'Ali', 'email' => 'ali@test.com', 'phone' => '0129999999',
            'password' => Hash::make('user123'), 'role' => 'user']);
    }

    private function makeExperience(string $name = 'Laksa Tour', float $price = 35): Experience
    {
        $vendor = VendorProfile::create(['name' => 'Kopitiam', 'phone' => '0821234567', 'location' => 'Kuching', 'status' => 'active']);
        return Experience::create(['vendor_profile_id' => $vendor->id, 'name' => $name, 'location' => 'Kuching',
            'category' => 'Food Tour', 'description' => 'Nice tour', 'price' => $price, 'status' => 'active']);
    }

    public function test_home_page_loads()
    {
        $this->get('/home')->assertStatus(200);
    }

    public function test_guest_is_redirected_to_login()
    {
        $this->get('/experiences')->assertRedirect('/login');
    }

    public function test_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Siti', 'email' => 'siti@test.com', 'phone' => '0123456789',
            'password' => 'secret12', 'password_confirmation' => 'secret12',
        ]);
        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', ['email' => 'siti@test.com', 'role' => 'user']);
    }

    public function test_register_fails_when_fields_empty()
    {
        $this->post('/register', [])->assertSessionHasErrors(['name', 'email', 'phone', 'password']);
    }

    public function test_login_with_correct_and_wrong_password()
    {
        $this->makeUser();
        $this->post('/login', ['email' => 'ali@test.com', 'password' => 'wrongpass'])->assertSessionHasErrors('email');
        $this->post('/login', ['email' => 'ali@test.com', 'password' => 'user123'])->assertRedirect('/dashboard');
    }

    public function test_admin_can_create_experience()
    {
        $admin = $this->makeAdmin();
        $vendor = VendorProfile::create(['name' => 'V', 'phone' => '0821234567', 'location' => 'Kuching', 'status' => 'active']);

        $this->actingAs($admin)->post('/experiences', [
            'vendor_profile_id' => $vendor->id, 'name' => 'Satay Night', 'location' => 'Kuching',
            'category' => 'Night Market', 'description' => 'Grilled satay', 'price' => 18, 'status' => 'active',
        ])->assertRedirect('/experiences');

        $this->assertDatabaseHas('experiences', ['name' => 'Satay Night']);
    }

    public function test_normal_user_cannot_create_experience()
    {
        $this->actingAs($this->makeUser())->get('/experiences/create')->assertStatus(403);
    }

    public function test_search_experience_by_name()
    {
        $this->makeExperience('Laksa Tour');
        $this->makeExperience('Satay Walk');

        $this->actingAs($this->makeUser())->get('/experiences?q=Laksa')
            ->assertSee('Laksa Tour')->assertDontSee('Satay Walk');
    }

    public function test_active_experience_cannot_be_deleted()
    {
        $exp = $this->makeExperience();
        $this->actingAs($this->makeAdmin())->delete('/experiences/' . $exp->id);
        $this->assertDatabaseHas('experiences', ['id' => $exp->id]);
    }

    public function test_user_booking_total_price_is_calculated()
    {
        $user = $this->makeUser();
        $exp = $this->makeExperience('Laksa Tour', 35);

        $this->actingAs($user)->post('/bookings', [
            'experience_id' => $exp->id, 'booking_date' => now()->addDays(3)->toDateString(), 'pax' => 3,
        ])->assertRedirect('/bookings');

        $this->assertDatabaseHas('bookings', ['user_id' => $user->id, 'pax' => 3, 'total_price' => 105.00]);
    }

    public function test_user_cannot_edit_other_users_booking()
    {
        $owner = $this->makeUser();
        $exp = $this->makeExperience();
        $booking = Booking::create(['user_id' => $owner->id, 'experience_id' => $exp->id,
            'booking_date' => now()->addDay()->toDateString(), 'pax' => 1, 'total_price' => 35, 'status' => 'pending']);

        $other = User::create(['name' => 'Other', 'email' => 'other@test.com', 'phone' => '0120000000',
            'password' => Hash::make('abc12345'), 'role' => 'user']);

        $this->actingAs($other)->get('/bookings/' . $booking->id . '/edit')->assertStatus(403);
    }

    public function test_user_can_add_review()
    {
        $user = $this->makeUser();
        $exp = $this->makeExperience();

        $this->actingAs($user)->post('/experiences/' . $exp->id . '/reviews', [
            'rating' => 5, 'comment' => 'Very nice food!',
        ]);
        $this->assertDatabaseHas('reviews', ['experience_id' => $exp->id, 'rating' => 5]);
    }
}
