<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InternetRequest;

class InternetRequestsController extends Controller {
    public function index() {
        return view('admin.requests.internet');
    }

    public function show() {

        $internetRequests = InternetRequest::all();

        return response()->json($internetRequests);
    }
}