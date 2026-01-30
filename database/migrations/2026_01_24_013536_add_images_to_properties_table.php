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
        // This migration may run after a schema where these columns already exist.
        if (Schema::hasColumn('properties', 'feature_image') && Schema::hasColumn('properties', 'banner_image')) {
            return;
        }

        Schema::table('properties', function (Blueprint $table) {
            if (!Schema::hasColumn('properties', 'feature_image')) {
                $table->string('feature_image')->nullable()->after('listing_type');
            }
            if (!Schema::hasColumn('properties', 'banner_image')) {
                $table->string('banner_image')->nullable()->after('feature_image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $cols = [];
            if (Schema::hasColumn('properties', 'feature_image')) {
                $cols[] = 'feature_image';
            }
            if (Schema::hasColumn('properties', 'banner_image')) {
                $cols[] = 'banner_image';
            }

            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
};
