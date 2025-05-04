<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    public function login(Request $request) {

        $request->validate([
            'biometricID' => 'required|numeric',
            'first_name'=> 'required|string',
        ]);

        $user = User::where('biometricID', $request->biometricID)
                    ->where('first_name', $request->first_name)
                    ->first();

        if ($user) {
            $remember = $request->has('remember');
            Auth::login($user, $remember);
            $request ->session()->regenerate();

            if ($user->role == 'admin') {
                return response()->json([
                    'success' => true,
                    'message' => 'Login Successful!',
                    'first_name' => $user->first_name,
                    'redirect' => route('admin.dashboard.index')
                ]);
            } else if ($user->role == 'user') {
                return response()->json([
                    'success' => true,
                    'message' => 'Login Successful',
                    'first_name' => $user->first_name,
                    'redirect' => route('user.request.internet')
                ]);
            }
        }

        return response()->json([
            'error' => true,
            'message' => 'Login Failed',
            'redirect' => url('/')
        ]);
    }

    public function logout(Request $request) {

        if (Auth::check()) {
            $user = Auth::user();

            Auth::logout();

            User::where('id', $user->id)->update(['remember_token' => null]);

            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return response()->json([
            'success' => true,
            'message' => 'Logout Successful',
            'first_name' => $user->first_name,
            'redirect' => route('home')
        ]);
    }
}