<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('dashboards.admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', 'logo', 'favicon', 'banners']);

        foreach ($data as $key => $value) {
            SiteSetting::set($key, $value);
        }

        if ($request->hasFile('logo')) {
            // Delete old logo
            $oldLogo = SiteSetting::get('logo');
            if ($oldLogo) {
                Storage::disk('s3')->delete($oldLogo);
            }
            $path = $request->file('logo')->store('2020Homes/site', 's3');
            SiteSetting::set('logo', $path);
        }

        if ($request->hasFile('favicon')) {
            // Delete old favicon
            $oldFavicon = SiteSetting::get('favicon');
            if ($oldFavicon) {
                Storage::disk('s3')->delete($oldFavicon);
            }
            $path = $request->file('favicon')->store('2020Homes/site', 's3');
            SiteSetting::set('favicon', $path);
        }

        if ($request->hasFile('banners')) {
            // Delete old banners
            $oldBanners = SiteSetting::get('banners');
            if ($oldBanners) {
                $paths = json_decode($oldBanners, true);
                if (is_array($paths)) {
                    foreach ($paths as $oldPath) {
                        Storage::disk('s3')->delete($oldPath);
                    }
                }
            }

            $bannerPaths = [];
            foreach ($request->file('banners') as $banner) {
                $bannerPaths[] = $banner->store('2020Homes/banner_image', 's3');
            }
            SiteSetting::set('banners', json_encode($bannerPaths));
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
