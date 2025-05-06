<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InternetRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InternetRequestsController extends Controller {
    public function index() {
        return view('admin.requests.internet');
    }

    public function show() {

        $internetRequests = InternetRequest::orderBy('id', 'asc')->get();

        return response()->json([ 'data' => $internetRequests ]);
    }

    public function print($id){

        $user = Auth::user();

        if ($user->role === 'admin') {
            $internetRequest = InternetRequest::findOrFail($id);

            $admin = User::where('role', 'admin')->where('biometricID', $internetRequest->pin_code)->first();

            if ($internetRequest->pin_code === $admin->biometricID) {
                $adminName = $admin;
            }
        }

        return view('print.print-internet-request', compact('internetRequest', 'adminName'));
    }
}