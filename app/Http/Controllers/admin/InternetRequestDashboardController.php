<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class InternetRequestDashboardController extends Controller {
    public function index() {
        return view('admin.internet-requests');
    }
}