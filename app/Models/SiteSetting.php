<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        if (!$setting) {
            return $default;
        }

        $value = $setting->value;

        // Try to decode JSON values (arrays/objects) automatically
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }

        return $value;
    }

    public static function set($key, $value)
    {
        // If value is array or object, store as JSON
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value);
        }

        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /**
     * Get the S3 URL for a setting.
     */
    public static function url($key, $default = null)
    {
        $value = self::get($key);
        if (!$value) {
            return $default;
        }

        // If value is an array (e.g., banners), return array of URLs
        if (is_array($value)) {
            return array_map(function ($p) {
                return \Illuminate\Support\Facades\Storage::disk('s3')->url($p);
            }, $value);
        }

        return \Illuminate\Support\Facades\Storage::disk('s3')->url($value);
    }
}
