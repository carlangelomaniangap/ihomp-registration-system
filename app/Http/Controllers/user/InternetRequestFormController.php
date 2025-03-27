<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

class InternetRequestFormController extends Controller {
    public function index() {
        return view('user.new-internet-request');
    }
}