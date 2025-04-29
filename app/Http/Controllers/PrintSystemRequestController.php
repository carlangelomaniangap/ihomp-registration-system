<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SystemRequest;
use App\Models\User;

class PrintSystemRequestController extends Controller {
    public function print($id){

        $systemRequest = SystemRequest::findOrFail($id);

        $admin = User::where('role', 'admin')->where('biometricID', $systemRequest->pin_code)->first();

        if ($systemRequest->pin_code === $admin->biometricID) {
            $adminName = $admin;
        }

        return view('print.print-system-request', compact('systemRequest', 'adminName'));
    }
}