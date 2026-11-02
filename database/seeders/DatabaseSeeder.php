<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Experience;
use App\Models\Review;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin KampungRelish', 'email' => 'admin@kampungrelish.test',
            'phone' => '0123456789', 'password' => Hash::make('admin123'), 'role' => 'admin',
        ]);
        $user = User::create([
            'name' => 'Aisyah Rahman', 'email' => 'aisyah@kampungrelish.test',
            'phone' => '0129876543', 'password' => Hash::make('user123'), 'role' => 'user',
        ]);

        $v1 = VendorProfile::create(['name' => 'Madam Ling Kopitiam', 'phone' => '0821234567', 'location' => 'Kuching Waterfront, Kuching', 'description' => 'Family kopitiam famous for Sarawak laksa.', 'status' => 'active']);
        $v2 = VendorProfile::create(['name' => 'Uncle Wong Kitchen', 'phone' => '0829876543', 'location' => 'Padungan, Kuching', 'description' => 'Small kitchen that runs cooking classes.', 'status' => 'active']);
        $v3 = VendorProfile::create(['name' => 'Satok Traders', 'phone' => '0823456789', 'location' => 'Satok, Kuching', 'description' => 'Local traders at the Satok weekend market.', 'status' => 'active']);
        VendorProfile::create(['name' => 'Old Bazaar Cafe', 'phone' => '0825551234', 'location' => 'Main Bazaar, Kuching', 'description' => 'Closed for renovation.', 'status' => 'inactive']);

        $e1 = Experience::create(['vendor_profile_id' => $v1->id, 'name' => 'Sarawak Laksa Tasting', 'location' => 'Kuching Waterfront, Kuching', 'category' => 'Food Tour', 'description' => 'Taste authentic Sarawak laksa with a local guide.', 'menu' => 'Sarawak laksa, iced tea', 'price' => 35.00, 'status' => 'active']);
        $e2 = Experience::create(['vendor_profile_id' => $v2->id, 'name' => 'Kolok Mee Cooking Class', 'location' => 'Padungan, Kuching', 'category' => 'Cooking Class', 'description' => 'Learn to make kolok mee noodles from scratch.', 'menu' => 'Kolok mee, iced coffee', 'price' => 120.00, 'status' => 'active']);
        $e3 = Experience::create(['vendor_profile_id' => $v3->id, 'name' => 'Satok Weekend Market Walk', 'location' => 'Satok, Kuching', 'category' => 'Street Food', 'description' => 'Try local snacks and fruits at the weekend market.', 'menu' => 'Kuih penyaram, ikan bakar, fresh fruits', 'price' => 25.50, 'status' => 'active']);
        Experience::create(['vendor_profile_id' => $v3->id, 'name' => 'Midnight Satay Night', 'location' => 'Kuching Waterfront, Kuching', 'category' => 'Night Market', 'description' => 'Enjoy grilled satay at the night market.', 'menu' => 'Chicken satay, ketupat, air tebu', 'price' => 18.00, 'status' => 'inactive']);

        Review::create(['user_id' => $user->id, 'experience_id' => $e1->id, 'rating' => 5, 'comment' => 'Best laksa I have ever tried!']);
        Review::create(['user_id' => $user->id, 'experience_id' => $e2->id, 'rating' => 4, 'comment' => 'Fun class, the instructor was friendly.']);
        Review::create(['user_id' => $admin->id, 'experience_id' => $e3->id, 'rating' => 5, 'comment' => 'Great variety of snacks at a good price.']);

        Booking::create(['user_id' => $user->id, 'experience_id' => $e1->id, 'booking_date' => now()->addDays(7)->toDateString(), 'pax' => 2, 'total_price' => 70.00, 'status' => 'confirmed']);
    }
}
