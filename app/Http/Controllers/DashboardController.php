<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin' || $user->role === 'superadmin') {
            $totalProperties = \App\Models\Property::count();
            $activeProperties = \App\Models\Property::where('status', 'available')->count();
            $pendingProperties = \App\Models\Property::where('is_verified', false)->count();

            $users = \App\Models\User::latest()->take(10)->get();
            $totalUsers = \App\Models\User::count();

            $recentProperties = \App\Models\Property::with('user')->latest()->take(5)->get();
            $enquiries = \App\Models\Enquiry::latest()->take(10)->get();

            return view('dashboards.admin.index', compact(
                'totalProperties',
                'activeProperties',
                'pendingProperties',
                'users',
                'totalUsers',
                'recentProperties',
                'enquiries'
            ));
        } elseif ($user->role === 'vendor') {
            return view('dashboards.vendor.index');
        } elseif ($user->role === 'staff') {
            // Check if staff dashboard exists, otherwise admin or maintenance
            if (view()->exists('dashboards.staff.index')) {
                return view('dashboards.staff.index');
            }
            return view('dashboards.admin.index'); // Fallback to admin for now
        }

        // Standard user or others
        return view('layouts.dashboard');
    }

    /**
     * Show full enquiries list for admin/staff.
     */
    public function enquiries(Request $request)
    {
        $enquiries = \App\Models\Enquiry::latest()->paginate(25);

        return view('dashboards.admin.enquiries', compact('enquiries'));
    }

    /**
     * Show full users list for admin/staff.
     */
    public function users(Request $request)
    {
        $users = \App\Models\User::latest()->paginate(25);

        return view('dashboards.admin.users', compact('users'));
    }

    /**
     * Show walk-in enquiry form.
     */
    public function walkInForm()
    {
        return view('dashboards.admin.enquiries.walk-in');
    }

    /**
     * Store walk-in enquiry.
     */
    public function storeWalkIn(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'preferred_date' => 'nullable|date|after_or_equal:today',
            'message' => 'nullable|string|max:1000',
        ]);

        try {
            $enquiry = \App\Models\Enquiry::create([
                'name' => $validated['name'],
                'email' => $validated['email'] ?? 'walk-in@2020homes.local',
                'phone' => $validated['phone'],
                'preferred_date' => $validated['preferred_date'] ?? null,
                'message' => $validated['message'] ?? null,
                'source' => 'walk_in',
                'status' => 1,
            ]);

            \Log::info('Walk-in enquiry created', ['id' => $enquiry->id]);

            // Send notification email to admin
            $adminEmail = config('mail.from.address') ?? 'info@2020homes.com';
            \Illuminate\Support\Facades\Mail::to($adminEmail)->queue(new \App\Mail\EnquiryNotificationMail($enquiry));

            return redirect()->route('admin.enquiries.index')
                ->with('success', 'Walk-in enquiry recorded successfully!');
        } catch (\Exception $e) {
            \Log::error('Walk-in enquiry failed: ' . $e->getMessage());
            return redirect()->back()
                ->withErrors('Unable to record walk-in enquiry. Please try again.');
        }
    }
}
