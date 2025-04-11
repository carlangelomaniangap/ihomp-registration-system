<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\InternetRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InternetRequestController extends Controller {
    public function index() {

        $user = Auth::user();
        return view('user.request.internet', compact('user'));
    }
    public function store(Request $request) {

        $user = Auth::user();

        $request->validate([
            'role' => 'required|string',
            'biometricID' => 'required|integer',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'medical_doctor' => 'required|in:Yes,No',
            'employment_status' => 'required|in:Regular/Permanent,Job Order,Temporary/COS,Medical Intern',
            'division' => 'required|in:ANCILLARY,FINANCE,HOPS,MCC,MEDICAL,NURSING',
            'department' => 'required|string',
            'position' => 'required|string',
            'request_number' => 'required|string',
            'reason' => 'required|string',
            'device_type' => 'required|in:Android Smartphone,Android Tablet,Windows Laptop,iPhone,iPad,MacBook',
            'wifi_mac_address' => 'required',
            'pin_code' => 'required|integer',
        ]);

        $admin = User::where('role', 'admin')->first();

        if ($request->pin_code != $admin->biometricID) {
            return response()->json([
                'error' => true,
                'message' => 'Submission Failed',
            ]);
        }

        InternetRequest::create([
            'role' => $request->input('role'),
            'biometricID' => $request->input('biometricID'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'medical_doctor' => $request->input('medical_doctor'),
            'employment_status' => $request->input('employment_status'),
            'division' => $request->input('division'),
            'department' => $request->input('department'),
            'position' => $request->input('position'),
            'request_number' => $request->input('request_number'),
            'reason' => $request->input('reason'),
            'device_type' => $request->input('device_type'),
            'wifi_mac_address' => $request->input('wifi_mac_address'),
            'pin_code' => $request->input('pin_code'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Submission Successful!',
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'redirect' => route('user.request.internet')
        ]);
    }
}