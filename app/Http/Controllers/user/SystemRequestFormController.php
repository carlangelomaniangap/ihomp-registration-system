<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

class SystemRequestFormController extends Controller {
    public function index() {
        return view('user.new-system-request');
    }
}