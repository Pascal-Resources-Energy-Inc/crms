<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealerController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('dealers');
    }
}
