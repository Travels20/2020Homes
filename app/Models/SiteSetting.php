<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value)
    {
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

        return \Illuminate\Support\Facades\Storage::disk('s3')->url($value);
    }
}
