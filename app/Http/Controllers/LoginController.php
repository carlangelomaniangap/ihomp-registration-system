<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    public function login(Request $request) {
        
        $credentials = $request->validate([
            'biometricID' => 'required|integer',
            'name'=> 'required|string',
        ]);

        $user = User::where([
            'biometricID' => $credentials['biometricID'],
            'name' => $credentials['name']
        ])->first();

        if ($user) {
            Auth::login($user); 
            $request ->session()->regenerate();

            if ($user->role == 'admin') {
                return response()->json([
                    'success' => true,
                    'message' => 'Login Successful',
                    'name' => $user->name,
                    'redirect' => route('admin.requests.internet')
                ]);
            } else if ($user->role == 'user') {
                return response()->json([
                    'success' => true,
                    'message' => 'Login Successful',
                    'name' => $user->name,
                    'redirect' => route('user.request.internet')
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Login Failed',
                'redirect' => url('/')
            ]);
        }
    }

    public function logout(Request $request) {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}