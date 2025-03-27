<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class SystemRequestDashboardController extends Controller {
    public function index() {
        return view('admin.system-requests');
    }
}