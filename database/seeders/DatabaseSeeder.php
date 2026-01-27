<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Users
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@2020homes.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'phone' => '1234567890',
            'status' => 'active',
        ]);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@2020homes.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '0987654321',
            'status' => 'active',
        ]);

        $staff = User::create([
            'name' => 'Staff Member',
            'email' => 'staff@2020homes.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'phone' => '1122334455',
            'status' => 'active',
        ]);

        $vendor = User::create([
            'name' => 'Vendor User',
            'email' => 'vendor@2020homes.com',
            'password' => Hash::make('password'),
            'role' => 'vendor',
            'phone' => '5544332211',
            'status' => 'active',
        ]);

        // 2. Create Dummy Properties
        Property::create([
            'user_id' => $vendor->id,
            'title' => 'Luxury Villa in Chennai',
            'slug' => 'luxury-villa-Chennai',
            'description' => 'A beautiful luxury villa with swimming pool and garden.',
            'property_type' => 'house', // generic type for now
            'listing_type' => 'sale',
            'city' => 'Chennai',
            'state' => 'Tamil Nadu',
            'price' => 25000000.00,
            'area' => 4500,
            'status' => 'available',
            'is_featured' => true,
        ]);

         Property::create([
            'user_id' => $vendor->id,
            'title' => '2BHK Apartment in Gachibowli',
            'slug' => '2bhk-apartment-gachibowli',
            'description' => 'Modern apartment near IT park.',
            'property_type' => 'flat',
            'listing_type' => 'rent',
            'city' => 'Coimbatore',
            'state' => 'Tamil Nadu',
            'price' => 35000.00,
            'area' => 1200,
            'bedrooms' => 2,
            'bathrooms' => 2,
            'status' => 'available',
        ]);

        Property::create([
            'user_id' => $admin->id,
            'title' => 'Agricultural Land in Madurai',
            'slug' => 'agri-land-Madurai',
            'description' => 'Fertile land suitable for farming.',
            'property_type' => 'agriculture',
            'listing_type' => 'sale',
            'city' => 'Madurai',
            'state' => 'Tamil Nadu',
            'price' => 5000000.00,
            'area' => 2,
            'area_unit' => 'acre',
            'status' => 'available',
        ]);
    }
}
