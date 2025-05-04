<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InternetRequest;
use App\Models\SystemRequest;

class DashboardController extends Controller {
    public function index() {
        return view('admin.dashboard.index');
    }

    public function refresh() {
        $internetRequest = InternetRequest::count();
        $systemRequest = SystemRequest::count();

        return response()->json([
            'internetRequest'=> $internetRequest,
            'systemRequest'=> $systemRequest
        ]);
    }
}