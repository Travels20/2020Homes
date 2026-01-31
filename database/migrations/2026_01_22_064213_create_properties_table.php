<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Owner/Vendor
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('other_content')->nullable();
            $table->string('property_type'); // distinct: plot, flat, agriculture
            $table->string('listing_type')->default('sale'); // sale, rent

            // Location
            $table->string('address')->nullable();
            $table->string('city');
            $table->string('city_area')->nullable();
            // $table->string('state');
            $table->string('pincode')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            // Details
            $table->decimal('price', 15, 2);
            $table->decimal('area', 10, 2);
            $table->string('area_unit')->default('sq_ft'); // sq_ft, sq_yard, acre, hectare

            // Specific details based on type
            $table->integer('bedrooms')->nullable(); // For flats
            $table->integer('bathrooms')->nullable(); // For flats
            $table->boolean('furnished')->default(false); // For flats
            $table->boolean('parking')->default(false); // For flats

            // Status
            $table->string('status')->default('available'); // available, sold, reserved
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_verified')->default(false);

            $table->string('feature_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->json('gallery_images')->nullable();


            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
