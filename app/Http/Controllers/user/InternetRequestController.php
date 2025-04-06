<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\InternetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InternetRequestController extends Controller {
    public function index() {

        $user = Auth::user();
        return view('user.request.internet', compact('user'));
    }

    public function store(Request $request) {
        $request->validate([
            'role' => 'required|string',
            'biometricID' => 'required|integer',
            'name' => 'required|string',
            'medical_doctor' => 'required|string',
            'employment_status' => 'required|string',
            'division' => 'required|string',
            'department' => 'required|string',
            'position' => 'required|string',
            'request_number' => 'required',
            'reason' => 'required|string',
            'device_type' => 'required|string',
            'wifi_mac_address' => 'required',
            'pin_code' => 'required',
        ]);

        InternetRequest::create([
            'role' => $request->input('role'),
            'biometricID' => $request->input('biometricID'),
            'name' => $request->input('name'),
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
            'message' => 'Submitted successfully!',
            'redirect' => route('user.request.internet')
        ]);
    }
}