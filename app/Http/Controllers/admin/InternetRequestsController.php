<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InternetRequest;

class InternetRequestsController extends Controller {
    public function index() {
        return view('admin.requests.internet');
    }

    public function show() {

        $internetRequests = InternetRequest::orderBy('id', 'asc')->get();

        return response()->json([ 'data' => $internetRequests ]);
    }
}