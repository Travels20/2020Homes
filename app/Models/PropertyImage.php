<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'image_path',
        'is_primary',
        'sort_order',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the image URL from S3.
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return asset('images/bannerimage.webp');
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($this->image_path);
    }
}
