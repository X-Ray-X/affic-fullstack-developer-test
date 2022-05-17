<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function callback(Request $request) {
        dd($request->all());
    }
}
