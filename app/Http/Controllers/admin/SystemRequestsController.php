<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SystemRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SystemRequestsController extends Controller {
    public function index() {
        return view('admin.requests.system');
    }

    public function show() {

        $systemRequests = SystemRequest::orderBy('id', 'asc')->get();

        return response()->json([ 'data' => $systemRequests ]);
    }

    public function print($id){

        $user = Auth::user();

        if ($user->role === 'admin') {
            $systemRequest = SystemRequest::findOrFail($id);

            $admin = User::where('role', 'admin')->where('biometricID', $systemRequest->pin_code)->first();

            if ($systemRequest->pin_code === $admin->biometricID) {
                $adminName = $admin;
            }
        }

        return view('print.print-system-request', compact('systemRequest', 'adminName'));
    }
}