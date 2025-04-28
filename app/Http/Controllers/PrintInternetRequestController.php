<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InternetRequest;
use App\Models\User;

class PrintInternetRequestController extends Controller {
    public function print($id){

        $internetRequest = InternetRequest::findOrFail($id);

        $admin = User::where('role', 'admin')->where('biometricID', $internetRequest->pin_code)->first();

        if ($internetRequest->pin_code === $admin->biometricID) {
            $adminName = $admin;
        }

        return view('print.print-internet-request', compact('internetRequest', 'adminName'));
    }
}