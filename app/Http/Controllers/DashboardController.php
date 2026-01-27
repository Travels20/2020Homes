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
            
            $users = \App\Models\User::latest()->take(5)->get();
            $totalUsers = \App\Models\User::count();
            
            $recentProperties = \App\Models\Property::with('user')->latest()->take(5)->get();

            return view('dashboards.admin.index', compact(
                'totalProperties', 
                'activeProperties', 
                'pendingProperties',
                'users',
                'totalUsers',
                'recentProperties'
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
}
