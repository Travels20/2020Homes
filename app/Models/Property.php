<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'property_type',
        'listing_type',
        'feature_image',
        'banner_image',
        'address',
        'city',
        'state',
        'pincode',
        'latitude',
        'longitude',
        'price',
        'area',
        'area_unit',
        'bedrooms',
        'bathrooms',
        'furnished',
        'parking',
        'status',
        'is_featured',
        'is_verified',
        'created_by',
        'updated_by',
    ];

     protected $casts = [
        'gallery_images' => 'array',
        'is_featured' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class)->orderBy('sort_order');
    }

    public function primaryImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_primary', true);
    }

    /**
     * Get the feature image URL from S3.
     */
    public function getFeatureImageUrlAttribute()
    {
        if (!$this->feature_image) {
            return asset('images/bannerimage.webp');
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($this->feature_image);
    }

    /**
     * Get the banner image URL from S3.
     */
    public function getBannerImageUrlAttribute()
    {
        if (!$this->banner_image) {
            return asset('images/bannerimage.webp');
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($this->banner_image);
    }
}
