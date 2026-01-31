<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Enquiry;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showVendorLogin()
    {
        return view('auth.vendor-login');
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|numeric|digits:10',
            'email' => 'nullable|email'
        ]);

        $contact = $request->phone ?? $request->email;
        $type = $request->phone ? 'mobile' : 'email';

        $user = null;
        if ($request->email) {
            $user = User::where('email', $request->email)->first();
        }
        if (!$user && $request->phone) {
            $user = User::where('phone', $request->phone)->first();
        }

        $userName = $user ? $user->name : 'Guest';

        if (!$contact) {
            return response()->json(['success' => false, 'message' => 'Please enter a valid phone number or email.'], 422);
        }

        try {
            $otp = rand(100000, 999999);
            Session::put('otp', $otp);
            Session::put('contact', $contact);
            Session::put('type', $type);

            if ($type === 'email') {
                Mail::to($contact)->send(new SendOtpMail($otp, $userName));
            }
            if ($type === 'mobile') {
                $smsSent = $this->sendSms($contact, $otp, $userName);
                if (!$smsSent) {
                    return response()->json(['success' => false, 'message' => 'Failed to send OTP via SMS.'], 500);
                }
            }
            return response()->json(['success' => true, 'message' => 'OTP sent successfully!']);
        } catch (\Exception $e) {
            Log::error('OTP sending failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Unable to send OTP.'], 500);
        }
    }

    private function sendSms($phone, $otp, $userName)
    {
        $apiUrl = 'https://rest.qikberry.ai/v1/sms/messages';
        $apiKey = '5c3876075d901cd1468c03949153b358';
        $message = "Dear {$userName}, Welcome! Your 2020Homes OTP is {$otp}. Valid for 10 mins.";

        try {
            $response = Http::withHeaders(['Authorization' => "Bearer $apiKey"])
                ->withoutVerifying()
                ->post($apiUrl, [
                    'to' => '+91' . $phone,
                    'sender' => 'TR2020',
                    'service' => 'SI',
                    'template_id' => '1707173769422420228',
                    'message' => $message,
                ]);
            return $response->successful();
        } catch (\Exception $e) {
            Log::error('SMS API Exception: ' . $e->getMessage());
            return false;
        }
    }

    public function verifyOTP(Request $request)
    {
        $sessionOtp = Session::get('otp');
        $sessionContact = Session::get('contact');
        $sessionType = Session::get('type');

        if (!$sessionOtp || !$sessionContact || !$sessionType) {
            return response()->json(['success' => false, 'message' => 'Session expired.'], 400);
        }

        if ($request->otp != $sessionOtp || $request->contact != $sessionContact) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP.'], 400);
        }

        try {
            if ($sessionType === 'mobile') {
                $user = User::where('phone', $sessionContact)->first() ?: User::create([
                    'phone' => $sessionContact,
                    'name' => 'Guest',
                    'email' => $sessionContact . '@temp.com',
                    'password' => Hash::make(rand(100000, 999999)),
                    'role' => 'vendor',
                ]);
            } else {
                $user = User::where('email', $sessionContact)->first() ?: User::create([
                    'email' => $sessionContact,
                    'name' => 'Guest',
                    'password' => Hash::make(rand(100000, 999999)),
                    'role' => 'vendor',
                ]);
            }

            Enquiry::create([
                'source' => 'VendorLoginPage',
                'mobile' => ($sessionType === 'mobile') ? $sessionContact : null,
                'email' => ($sessionType === 'email') ? $sessionContact : null,
                'status' => 1,
            ]);

            Auth::login($user);
            Session::forget(['otp', 'contact', 'type']);
            return response()->json(['success' => true, 'message' => 'Login successful!', 'redirect' => route('dashboard')]);
        } catch (\Exception $e) {
            Log::error('User login error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Authentication failed.'], 500);
        }
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
            'role' => 'user',
            'status' => 'active',
        ]);

        Auth::login($user);

        return redirect()->route('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
