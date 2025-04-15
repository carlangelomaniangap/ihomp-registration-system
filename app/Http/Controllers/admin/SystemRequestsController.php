<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SystemRequest;

class SystemRequestsController extends Controller {
    public function index() {
        return view('admin.requests.system');
    }

    public function show() {

        $systemRequests = SystemRequest::orderBy('id', 'asc')->get();

        return response()->json([ 'data' => $systemRequests ]);
    }
}