<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Enquiry;
use App\Mail\EnquiryNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function nriProperty()
    {
        return view('nri-property');
    }

    public function submitNriForm(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'form_type' => 'required|in:selling,maintenance',
                'property_type' => 'nullable|string|max:100',
                'property_location' => 'nullable|string|max:255',
                'message' => 'nullable|string|max:1000',
            ]);

            // Create or find user
            $user = null;
            if (Auth::check()) {
                $user = Auth::user();
            } else {
                $user = \App\Models\User::updateOrCreate(
                    ['email' => $validated['email']],
                    [
                        'name' => $validated['name'],
                        'phone' => $validated['phone'],
                        'password' => \Illuminate\Support\Str::random(16),
                        'role' => 'user',
                    ]
                );
            }

            $createData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'message' => "Form Type: {$validated['form_type']}\n" .
                            "Property Type: {$validated['property_type']}\n" .
                            "Location: {$validated['property_location']}\n" .
                            "Details: {$validated['message']}",
                'source' => 'nri_form_' . $validated['form_type'],
                'status' => 1,
            ];

            if (\Illuminate\Support\Facades\Schema::hasColumn('enquiries', 'user_id')) {
                $createData['user_id'] = $user->id;
            }

            $enquiry = Enquiry::create($createData);

            // Send notification email
            $adminEmail = config('mail.from.address') ?? 'info@2020homes.com';
            Mail::to($adminEmail)->queue(new EnquiryNotificationMail($enquiry));

        } catch (\Exception $e) {
            \Log::error('NRI Form submission failed: ' . $e->getMessage());
            return redirect()->back()->withErrors('Unable to submit your request. Please try again later.');
        }

        $formType = $request->form_type === 'selling' ? 'Selling' : 'Maintenance';
        return redirect()->back()->with('success', "Your {$formType} Property request has been submitted successfully! We will contact you soon.");
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

    public function storeAppointment(Request $request)
    {
        \Log::info('storeAppointment called', $request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'preferred_date' => 'required|date|after_or_equal:today',
            'message' => 'nullable|string|max:1000',
        ]);

        try {
            // Try to find existing user by email; update basic details or create a new user
            $user = null;
            if (!empty($validated['email'])) {
                $userModel = \App\Models\User::where('email', $validated['email'])->first();
                if ($userModel) {
                    $userModel->update([ 'name' => $validated['name'], 'phone' => $validated['phone'] ]);
                    $user = $userModel;
                } else {
                    $user = \App\Models\User::create([
                        'name' => $validated['name'],
                        'email' => $validated['email'],
                        'phone' => $validated['phone'],
                        'password' => \Illuminate\Support\Str::random(16),
                        'role' => 'user',
                    ]);
                }
            }

            $createData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'preferred_date' => $validated['preferred_date'],
                'message' => $validated['message'] ?? null,
                'source' => 'appointment_form',
                'status' => 1,
            ];

            // If enquiries table has user_id column, attach the user id
            if ($user && \Illuminate\Support\Facades\Schema::hasColumn('enquiries', 'user_id')) {
                $createData['user_id'] = $user->id;
            }

            $enquiry = Enquiry::create($createData);

            \Log::info('Enquiry created', ['id' => $enquiry->id ?? null]);

            // Send notification email to admin
            $adminEmail = config('mail.from.address') ?? 'info@2020homes.com';
            Mail::to($adminEmail)->queue(new EnquiryNotificationMail($enquiry));

        } catch (\Exception $e) {
            \Log::error('Enquiry create failed: ' . $e->getMessage(), [$e]);
            return redirect()->back()->withErrors('Unable to save your request at the moment. Please try again later.');
        }

        return redirect()->back()->with('success', 'Your consultation request has been submitted successfully! We will contact you soon.');
    }
}
