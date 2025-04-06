<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

class SystemRequestController extends Controller {
    public function index() {
        return view('user.request.system');
    }
}