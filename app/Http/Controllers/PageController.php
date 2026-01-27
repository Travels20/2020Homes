<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $featuredProperties = Property::where('status', 'available')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        return view('index', compact('featuredProperties'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function properties()
    {
        $properties = Property::where('status', 'available')->latest()->paginate(9);
        return view('properties', compact('properties'));
    }

    public function show($slug)
    {
        $property = Property::where('slug', $slug)
            ->with(['images', 'user'])
            ->firstOrFail();

        return view('property_show', compact('property'));
    }
}
