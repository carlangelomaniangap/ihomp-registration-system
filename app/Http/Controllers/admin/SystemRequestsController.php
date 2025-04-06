<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class SystemRequestsController extends Controller {
    public function index() {
        return view('admin.requests.system');
    }
}