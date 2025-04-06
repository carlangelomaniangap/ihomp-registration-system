<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

class InternetRequestController extends Controller {
    public function index() {
        return view('user.request.internet');
    }
}