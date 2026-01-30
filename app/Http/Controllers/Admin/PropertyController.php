<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    protected function isAdminOrSuperAdmin(): bool
    {
        $role = Auth::user()->role ?? null;
        return in_array($role, ['admin', 'superadmin'], true);
    }

    protected function isStaff(): bool
    {
        return (Auth::user()->role ?? null) === 'staff';
    }

    protected function findPropertyForCurrentUser(string $id, bool $withImages = false): Property
    {
        $query = Property::query();

        if ($withImages) {
            $query->with('images');
        }

        // Staff can only access their own properties.
        if ($this->isStaff()) {
            $query->where('user_id', Auth::id());
        }

        return $query->findOrFail($id);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::latest()->paginate(10);
        return view('dashboards.admin.properties.index', compact('properties'));
    }

    /**
     * Staff-only listing for properties created/owned by the staff user.
     */
    public function myProperties()
    {
        $properties = Property::where('user_id', Auth::id())->latest()->paginate(10);
        return view('dashboards.staff.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboards.admin.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'property_type' => 'required|in:plot,flat,agriculture',
            'listing_type' => 'required|in:sale,rent',
            'price' => 'required|numeric',
            'area' => 'required|numeric',
            'city' => 'required|string',
            'state' => 'required|string',
            'description' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'nearby_places' => 'nullable|array',
            'nearby_places.*.label' => 'nullable|string|max:255',
            'nearby_places.*.distance' => 'nullable|string|max:255',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'nullable|string',
            'faqs.*.answer' => 'nullable|string',
            'feature_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status' => 'nullable|in:draft,available,sold,reserved',
            // Admin-only (if present)
            'is_verified' => 'nullable|boolean',
        ]);

        $isAdmin = $this->isAdminOrSuperAdmin();

        // Create property first
        $slug = Str::slug($request->title) . '-' . time();

        $nearbyPlaces = $request->input('nearby_places', []);
        // Clean out completely empty rows and preserve structure for JSON storage
        $nearbyPlaces = array_values(array_filter($nearbyPlaces, function ($item) {
            return !empty($item['label']) || !empty($item['distance']);
        }));

        $faqs = $request->input('faqs', []);
        // Clean out completely empty FAQ rows and preserve structure for JSON storage
        $faqs = array_values(array_filter($faqs, function ($item) {
            return !empty($item['question']) || !empty($item['answer']);
        }));

        $property = Property::create([
            'user_id' => Auth::id(),
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description'],
            'property_type' => $validated['property_type'],
            'listing_type' => $validated['listing_type'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'price' => $validated['price'],
            'area' => $validated['area'],
            'area_unit' => $request->input('area_unit', 'sq_ft'),
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'nearby_places' => !empty($nearbyPlaces) ? $nearbyPlaces : null,
            'faqs' => !empty($faqs) ? $faqs : null,
            'status' => $validated['status'] ?? 'draft',
            'is_featured' => $isAdmin ? $request->has('is_featured') : false,
            'is_verified' => $isAdmin ? $request->boolean('is_verified', true) : false,
            'bedrooms' => $request->input('bedrooms'),
            'bathrooms' => $request->input('bathrooms'),
            'furnished' => $request->input('furnished', 0),
        ]);

        // Handle Feature Image Upload to S3
        if ($request->hasFile('feature_image')) {
            $path = $request->file('feature_image')
                ->store('2020Homes/feature_images', 's3');

            Storage::disk('s3')->setVisibility($path, 'public');

            $property->update(['feature_image' => $path]);
        }

        // Handle Banner Image Upload to S3
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')
                ->store('2020Homes/banner_images', 's3');

            Storage::disk('s3')->setVisibility($path, 'public');

            $property->update(['banner_image' => $path]);
        }

        // Handle Gallery Images Upload to S3
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('2020Homes/gallery_images', 's3');

                Storage::disk('s3')->setVisibility($path, 'public');

                \App\Models\PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                    'is_primary' => $index === 0, // First image as primary
                    'sort_order' => $index,
                ]);
            }
        }

        $redirectRoute = $this->isStaff() ? 'admin.my-properties' : 'admin.properties.index';

        return redirect()
            ->route($redirectRoute)
            ->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $property = $this->findPropertyForCurrentUser($id, true);

        // No dedicated admin/staff "show" blade yet - redirect to the public view.
        return redirect()->route('property.show', $property->slug);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $property = $this->findPropertyForCurrentUser($id, true);
        return view('dashboards.admin.properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $property = $this->findPropertyForCurrentUser($id);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'property_type' => 'required|in:plot,flat,agriculture',
            'listing_type' => 'required|in:sale,rent',
            'price' => 'required|numeric',
            'area' => 'required|numeric',
            'city' => 'required|string',
            'state' => 'required|string',
            'description' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'nearby_places' => 'nullable|array',
            'nearby_places.*.label' => 'nullable|string|max:255',
            'nearby_places.*.distance' => 'nullable|string|max:255',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'nullable|string',
            'faqs.*.answer' => 'nullable|string',
            'feature_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status' => 'nullable|in:draft,available,sold,reserved',
            // Admin-only (if present)
            'is_verified' => 'nullable|boolean',
        ]);

        $isAdmin = $this->isAdminOrSuperAdmin();

        $nearbyPlaces = $request->input('nearby_places', []);
        $nearbyPlaces = array_values(array_filter($nearbyPlaces, function ($item) {
            return !empty($item['label']) || !empty($item['distance']);
        }));

        $faqs = $request->input('faqs', []);
        $faqs = array_values(array_filter($faqs, function ($item) {
            return !empty($item['question']) || !empty($item['answer']);
        }));

        // Update basic fields
        $updateData = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'property_type' => $validated['property_type'],
            'listing_type' => $validated['listing_type'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'price' => $validated['price'],
            'area' => $validated['area'],
            'area_unit' => $request->input('area_unit', 'sq_ft'),
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'nearby_places' => !empty($nearbyPlaces) ? $nearbyPlaces : null,
            'faqs' => !empty($faqs) ? $faqs : null,
            'bedrooms' => $request->input('bedrooms'),
            'bathrooms' => $request->input('bathrooms'),
            'furnished' => $request->input('furnished', 0),
            'status' => $validated['status'] ?? $property->status,
            'updated_by' => Auth::id(),
        ];

        // Only admin/superadmin can set featured / verified.
        if ($isAdmin) {
            $updateData['is_featured'] = $request->has('is_featured');
            if ($request->has('is_verified')) {
                $updateData['is_verified'] = $request->boolean('is_verified');
            }
        }

        $property->update($updateData);

        // Handle Feature Image Update
        if ($request->hasFile('feature_image')) {
            // Delete old image from S3 if exists
            if ($property->feature_image) {
                Storage::disk('s3')->delete($property->feature_image);
            }

            $path = $request->file('feature_image')
                ->store('2020Homes/feature_images', 's3');

            Storage::disk('s3')->setVisibility($path, 'public');

            $property->update(['feature_image' => $path]);
        }

        // Handle Banner Image Update
        if ($request->hasFile('banner_image')) {
            // Delete old image from S3 if exists
            if ($property->banner_image) {
                Storage::disk('s3')->delete($property->banner_image);
            }

            $path = $request->file('banner_image')
                ->store('2020Homes/banner_images', 's3');

            Storage::disk('s3')->setVisibility($path, 'public');

            $property->update(['banner_image' => $path]);
        }

        // Handle New Gallery Images
        if ($request->hasFile('images')) {
            $lastSortOrder = $property->images()->max('sort_order') ?? -1;

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('2020Homes/gallery_images', 's3');

                Storage::disk('s3')->setVisibility($path, 'public');

                \App\Models\PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                    'is_primary' => false,
                    'sort_order' => $lastSortOrder + $index + 1,
                ]);
            }
        }

        $redirectRoute = $this->isStaff() ? 'admin.my-properties' : 'admin.properties.index';

        return redirect()
            ->route($redirectRoute)
            ->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $property = Property::findOrFail($id);

        // Delete feature image from S3
        if ($property->feature_image) {
            Storage::disk('s3')->delete($property->feature_image);
        }

        // Delete banner image from S3
        if ($property->banner_image) {
            Storage::disk('s3')->delete($property->banner_image);
        }

        // Delete all gallery images from S3
        foreach ($property->images as $image) {
            Storage::disk('s3')->delete($image->image_path);
            $image->delete();
        }

        $property->delete();

        return redirect()
            ->route('admin.properties.index')
            ->with('success', 'Property deleted successfully.');
    }

    /**
     * Delete a single gallery image
     */
    public function deleteImage(Request $request, $propertyId, $imageId)
    {
        $image = \App\Models\PropertyImage::where('property_id', $propertyId)
            ->where('id', $imageId)
            ->firstOrFail();

        // Delete from S3
        Storage::disk('s3')->delete($image->image_path);

        // Delete from database
        $image->delete();

        return response()->json(['success' => true]);
    }
}
