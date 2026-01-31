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
            'name' => '2020Homes Admin',
            'email' => 'admin@2020homes.com',
            'password' => Hash::make('Admin@2020Homes'),
            'role' => 'admin',
            'phone' => '9445002020',
            'status' => 'active',
        ]);

        $staff = User::create([
            'name' => 'Staff Member',
            'email' => 'staff@2020homes.com',
            'password' => Hash::make('Staff@2020Homes'),
            'role' => 'staff',
            'phone' => '1122334455',
            'status' => 'active',
        ]);

        $vendor = User::create([
            'name' => 'Vendor User',
            'email' => 'vendor@2020homes.com',
            'password' => Hash::make('Vendor@2020Homes'),
            'role' => 'vendor',
            'phone' => '8883464042',
            'status' => 'active',
        ]);

        // 2. Create Dummy Properties
        Property::create([
            'user_id' => $vendor->id,
            'title' => 'Luxury Villa in Chennai',
            'slug' => 'luxury-villa-Chennai',
            'description' => 'A beautiful luxury villa with swimming pool and garden.',
            'property_type' => 'house',
            'listing_type' => 'sale',
            'city' => 'Chennai',
            'state' => 'Tamil Nadu',
            'price' => 25000000.00,
            'area' => 4500,
            'status' => 'available',
            'is_featured' => true,
            'is_verified' => true,
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
            'is_verified' => true,
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
            'is_verified' => true,
        ]);

        // Additional 12 Properties
        Property::create([
            'user_id' => $vendor->id,
            'title' => 'Residential Plot in Adyar',
            'slug' => 'residential-plot-adyar',
            'description' => 'Prime location residential plot near metro station.',
            'property_type' => 'plot',
            'listing_type' => 'sale',
            'city' => 'Chennai',
            'state' => 'Tamil Nadu',
            'price' => 8500000.00,
            'area' => 1500,
            'status' => 'available',
            'is_featured' => true,
            'is_verified' => true,
        ]);

        Property::create([
            'user_id' => $vendor->id,
            'title' => '3BHK Villa in Oragadum',
            'slug' => '3bhk-villa-oragadum',
            'description' => 'Spacious villa with all modern amenities.',
            'property_type' => 'house',
            'listing_type' => 'sale',
            'city' => 'Chennai',
            'state' => 'Tamil Nadu',
            'price' => 18000000.00,
            'area' => 3200,
            'bedrooms' => 3,
            'bathrooms' => 3,
            'status' => 'available',
            'is_verified' => true,
        ]);

        Property::create([
            'user_id' => $vendor->id,
            'title' => '1BHK Flat in Velachery',
            'slug' => '1bhk-flat-velachery',
            'description' => 'Compact apartment for young professionals.',
            'property_type' => 'flat',
            'listing_type' => 'rent',
            'city' => 'Chennai',
            'state' => 'Tamil Nadu',
            'price' => 15000.00,
            'area' => 600,
            'bedrooms' => 1,
            'bathrooms' => 1,
            'status' => 'available',
            'is_verified' => true,
        ]);

        Property::create([
            'user_id' => $admin->id,
            'title' => 'Farmland in Kanchipuram',
            'slug' => 'farmland-kanchipuram',
            'description' => 'Agriculture land for cultivation.',
            'property_type' => 'agriculture',
            'listing_type' => 'sale',
            'city' => 'Kanchipuram',
            'state' => 'Tamil Nadu',
            'price' => 3500000.00,
            'area' => 3,
            'area_unit' => 'acre',
            'status' => 'available',
            'is_verified' => true,
        ]);

        Property::create([
            'user_id' => $vendor->id,
            'title' => '4BHK Bungalow in Thiruvanmiyur',
            'slug' => '4bhk-bungalow-thiruvanmiyur',
            'description' => 'Luxury bungalow with sea view.',
            'property_type' => 'house',
            'listing_type' => 'sale',
            'city' => 'Chennai',
            'state' => 'Tamil Nadu',
            'price' => 35000000.00,
            'area' => 5000,
            'bedrooms' => 4,
            'bathrooms' => 4,
            'status' => 'available',
            'is_featured' => true,
            'is_verified' => true,
        ]);

        Property::create([
            'user_id' => $vendor->id,
            'title' => 'Plot in Sivanchetti Garden',
            'slug' => 'plot-sivanchetti-garden',
            'description' => 'Well-located plot in residential area.',
            'property_type' => 'plot',
            'listing_type' => 'sale',
            'city' => 'Chennai',
            'state' => 'Tamil Nadu',
            'price' => 6500000.00,
            'area' => 1200,
            'status' => 'available',
            'is_verified' => true,
        ]);

        Property::create([
            'user_id' => $admin->id,
            'title' => '2BHK Flat in Perambur',
            'slug' => '2bhk-flat-perambur',
            'description' => 'Modern apartment with amenities.',
            'property_type' => 'flat',
            'listing_type' => 'rent',
            'city' => 'Chennai',
            'state' => 'Tamil Nadu',
            'price' => 25000.00,
            'area' => 950,
            'bedrooms' => 2,
            'bathrooms' => 2,
            'status' => 'available',
            'is_verified' => true,
        ]);

        Property::create([
            'user_id' => $vendor->id,
            'title' => 'Commercial Space in Nungambakkam',
            'slug' => 'commercial-space-nungambakkam',
            'description' => 'Prime commercial property for business.',
            'property_type' => 'house',
            'listing_type' => 'rent',
            'city' => 'Chennai',
            'state' => 'Tamil Nadu',
            'price' => 50000.00,
            'area' => 2000,
            'status' => 'available',
            'is_verified' => true,
        ]);

        Property::create([
            'user_id' => $vendor->id,
            'title' => 'Plot in Kelambakkam',
            'slug' => 'plot-kelambakkam',
            'description' => 'Large plot near highway.',
            'property_type' => 'plot',
            'listing_type' => 'sale',
            'city' => 'Chengalpattu',
            'state' => 'Tamil Nadu',
            'price' => 4500000.00,
            'area' => 2000,
            'status' => 'available',
            'is_featured' => true,
            'is_verified' => true,
        ]);

        Property::create([
            'user_id' => $admin->id,
            'title' => 'Agricultural Land in Sriperumbudur',
            'slug' => 'agri-sriperumbudur',
            'description' => 'Fertile agricultural land.',
            'property_type' => 'agriculture',
            'listing_type' => 'sale',
            'city' => 'Sriperumbudur',
            'state' => 'Tamil Nadu',
            'price' => 2500000.00,
            'area' => 1.5,
            'area_unit' => 'acre',
            'status' => 'available',
            'is_verified' => true,
        ]);

        Property::create([
            'user_id' => $vendor->id,
            'title' => '3BHK Apartment in Mogappair',
            'slug' => '3bhk-apartment-mogappair',
            'description' => 'Spacious apartment with parking.',
            'property_type' => 'flat',
            'listing_type' => 'sale',
            'city' => 'Chennai',
            'state' => 'Tamil Nadu',
            'price' => 12000000.00,
            'area' => 1600,
            'bedrooms' => 3,
            'bathrooms' => 3,
            'status' => 'available',
            'is_verified' => true,
        ]);

        Property::create([
            'user_id' => $vendor->id,
            'title' => '2BHK Plot in Poonamallee',
            'slug' => '2bhk-plot-poonamallee',
            'description' => 'Residential plot in developing area.',
            'property_type' => 'plot',
            'listing_type' => 'sale',
            'city' => 'Chennai',
            'state' => 'Tamil Nadu',
            'price' => 7000000.00,
            'area' => 1400,
            'status' => 'available',
            'is_verified' => true,
        ]);
    }
}
