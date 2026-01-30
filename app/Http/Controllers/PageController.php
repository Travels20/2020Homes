<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        $baseQuery = Property::query()
            ->where('status', 'available')
            ->where('is_verified', true);

        $featuredProperties = (clone $baseQuery)
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        // Separate sections for homepage
        $plotProperties = (clone $baseQuery)
            ->where('property_type', 'plot')
            ->latest()
            ->take(6)
            ->get();

        $flatProperties = (clone $baseQuery)
            ->where('property_type', 'flat')
            ->latest()
            ->take(6)
            ->get();

        $agricultureProperties = (clone $baseQuery)
            ->where('property_type', 'agriculture')
            ->latest()
            ->take(6)
            ->get();

        return view('index', compact(
            'featuredProperties',
            'plotProperties',
            'flatProperties',
            'agricultureProperties'
        ));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function properties(Request $request)
    {
        $rawType = strtolower((string) $request->query('type', ''));
        $typeMap = [
            'plot' => 'plot',
            'plots' => 'plot',
            'flat' => 'flat',
            'flats' => 'flat',
            'agriculture' => 'agriculture',
        ];
        $type = $typeMap[$rawType] ?? null;

        $city = $request->query('city');

        $query = Property::query()
            ->where('status', 'available')
            ->where('is_verified', true);

        if ($type) {
            $query->where('property_type', $type);
        }

        if (!empty($city)) {
            $query->where('city', $city);
        }

        $properties = $query->latest()->paginate(9)->withQueryString();

        return view('properties', [
            'properties' => $properties,
            'filterType' => $type,
            'filterCity' => $city,
        ]);
    }

    public function show($slug)
    {
        $property = Property::where('slug', $slug)
            ->with(['images', 'user'])
            ->firstOrFail();

        $user = Auth::user();
        $isAdmin = $user && in_array($user->role, ['admin', 'superadmin'], true);
        $isOwner = $user && (int) $property->user_id === (int) $user->id;

        // Hide drafts/unapproved listings from the public frontend.
        if ((!$property->is_verified || $property->status !== 'available') && !($isAdmin || $isOwner)) {
            abort(404);
        }

        return view('property_show', compact('property'));
    }
}
