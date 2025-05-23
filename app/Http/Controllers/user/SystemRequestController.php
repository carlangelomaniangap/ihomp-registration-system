<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\SystemRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SystemRequestController extends Controller {
    public function index() {

        $user = Auth::user();
        return view('user.request.system', compact('user'));
    }

    public function store(Request $request) {

        $user = Auth::user();

        $request->validate([
            'role' => 'required|string',
            'biometricID' => 'required|numeric',
            'username' => 'required|string',
            'password' => 'required|string',
            'medical_doctor' => 'required|string|in:Yes,No',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'birthday' => 'required|date',
            'sex' => 'required|string',
            'civil_status' => 'required|string',
            'email' => 'required|email',
            'mobile_number' => 'required|regex:/^09[0-9]{9}$/',
            'telephone_number' => 'required|string',
            'division' => 'required|string',
            'department' => 'required|string',
            'position' => 'required|string',
            'prc_license_number' => 'required|string',
            'expiration_date' => 'required|date',
            'employment_status' => 'required|string',
            'systems_to_be_enrolled' => 'required|array|min:1',
            'emr_sdn_user_profile' => 'required|string',
            'pin_code' => 'required|numeric',
        ]);

        $admin = User::where('role', 'admin')->where('biometricID', $request->pin_code)->first();

        if (!$admin) {
            return response()->json([
                'error' => true,
                'message' => 'Submission Failed',
            ]);
        }

        $systemRequest = SystemRequest::create([
            'role' => $request->input('role'),
            'biometricID' => $request->input('biometricID'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'medical_doctor' => $request->input('medical_doctor'),
            'first_name' => $request->input('first_name'),
            'middle_name'=> $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'birthday' => $request->input('birthday'),
            'sex' => $request->input('sex'),
            'civil_status' => $request->input('civil_status'),
            'email' => $request->input('email'),
            'mobile_number' => $request->input('mobile_number'),
            'telephone_number' => $request->input('telephone_number'),
            'division' => $request->input('division'),
            'department' => $request->input('department'),
            'position' => $request->input('position'),
            'prc_license_number' => $request->input('prc_license_number'),
            'expiration_date' => $request->input('expiration_date'),
            'employment_status' => $request->input('employment_status'),
            'systems_to_be_enrolled' => implode(',', $request->input('systems_to_be_enrolled')),
            'emr_sdn_user_profile' => $request->input('emr_sdn_user_profile'),
            'pin_code' => $request->input('pin_code'),
            'user_id' => $user->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Submission Successful!',
            'id' => $systemRequest->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'redirect' => route('user.request.system')
        ]);
    }

    public function print($id){

        $user = Auth::user();

        if ($user->role === 'user') {
            $systemRequest = SystemRequest::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        
            $admin = User::where('role', 'admin')->where('biometricID', $systemRequest->pin_code)->first();

            if ($systemRequest->pin_code === $admin->biometricID) {
                $adminName = $admin;
            }
        }

        return view('print.print-system-request', compact('systemRequest', 'adminName'));
    }
}